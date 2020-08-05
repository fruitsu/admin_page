@extends('layouts.admin', ['page_title' => __('admin.pages.edit.title')])

@section('content')

    @component('components.admin.heading', ['title' => 'admin.pages.edit.title'])
    @endcomponent

    <block-editor action="{{ route('admin.pages.update', [$page->slug]) }}">
        @csrf
        @method('patch')
        @foreach(config('app.locales') as $locale)
            <fieldset slot="{{ $locale }}">
                @if ($page->slug !== 'home')
                    <div class="form-group is-required{{ $errors->has('title') ? 'has-errors' : '' }}">
                        <label for="title" class="form-label">{{ __('admin.pages.fields.title') }}</label>
                        <input type="text" name="title[{{$locale}}]" class="form-control form-control-lg"
                            value="{{old('title.'.$locale) ?? $page->getTranslation('title', $locale) }}">
                    </div>

                    <div class="form-group">
                        <label for="body">{!! __('admin.pages.fields.body') !!}</label>
                        <wysiwyg
                        name="body[{{$locale}}]"
                        content="{{old('body.'.$locale) ?? $page->getTranslation('body', $locale) }}">
                        </wysiwyg>
                    </div>
                @endif

                @includeIf('partials.admin.meta', ['metas' => $page->metas])
            </fieldset>
        @endforeach

        @if ($page->slug !== 'home')

        <multi-uploader
                class="rounded my-4"
                :items="{{ json_encode(\App\Http\Resources\AdminImageResource::collection($page->getMedia())) }}">
        </multi-uploader>
        @endif

        <div class="mt-4">
            <button class="btn btn-primary">{{ __('buttons.save') }}</button>
        </div>
    </block-editor>
</form>

@endsection
