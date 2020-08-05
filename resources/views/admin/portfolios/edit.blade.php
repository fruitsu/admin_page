@extends('layouts.admin', ['page_title' => __('admin.portfolios.edit.title')])

@section('content')

    @component('components.admin.heading', ['title' => 'admin.portfolios.edit.title'])
    @endcomponent

    <block-editor action="{{ route('admin.portfolios.update', [$portfolio->slug]) }}">
        @csrf
        @method('patch')
        @foreach(config('app.locales') as $locale)

            <fieldset slot="{{ $locale }}">
                    <div class="form-group is-required{{ $errors->has('title') ? 'has-errors' : '' }}">
                        <label for="title" class="form-label">{{ __('admin.portfolios.fields.title') }}</label>
                        <input type="text" name="title[{{$locale}}]" class="form-control form-control-lg"
                            value="{{old('title.'.$locale) ?? $portfolio->getTranslation('title', $locale) }}">
                    </div>

                    <div class="form-group">
                        <label for="body">{{ __('admin.portfolios.fields.body') }}</label>
                        <wysiwyg
                        name="body[{{$locale}}]"
                        content="{{old('body.'.$locale) ?? $portfolio->getTranslation('body', $locale) }}">
                        </wysiwyg>
                    </div>

                @includeIf('partials.admin.meta', ['metas' => $portfolio->metas])
            </fieldset>
        @endforeach

        <multi-uploader
            class="rounded my-4"
            :items="{{ json_encode(\App\Http\Resources\AdminImageResource::collection($portfolio->getMedia())) }}">
        </multi-uploader>

        <div class="mt-4">
            <button class="btn btn-primary">{{ __('buttons.save') }}</button>
        </div>
    </block-editor>


@endsection
