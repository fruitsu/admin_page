@extends('layouts.admin', ['page_title' => __('admin.portfolios.create.title')])

@section('content')
    <block-editor action="{{ route('admin.portfolios.store', $portfolio) }}">
        @csrf

        <div class="form-group">
            <label for="slug">URL (slug)</label>
            <input type="text" name="slug" class="form-control form-control-lg" id="slug" value="{{old('slug') }}">
        </div>

        @foreach(config('app.locales') as $locale)
            <fieldset slot="{{ $locale }}">
                <div class="form-group is-required{{ $errors->has('title') ? 'has-errors' : '' }}">
                    <label for="title" class="form-label">{{ __('admin.portfolios.fields.title') }}</label>
                    <input type="text" name="title[{{$locale}}]" class="form-control form-control-lg"
                           value="{{old('title.'.$locale)}}">
                </div>

                <div class="form-group is-required{{ $errors->has('body') ? 'has-errors' : '' }}">
                    <label for="body" class="form-label">{{ __('admin.portfolios.fields.body') }}</label>
                    <wysiwyg name="body[{{$locale}}]" content="{{ old('body.'.$locale) }}"></wysiwyg>
                </div>
                @includeIf('partials.admin.meta', ['metas' => $portfolio->metas])
            </fieldset>
        @endforeach

        @if ($portfolio->slug !== 'home')
            <multi-uploader
                class="rounded my-4"
                :items="{{ json_encode(\App\Http\Resources\AdminImageResource::collection($portfolio->getMedia())) }}">
            </multi-uploader>
        @endif
        <div class="mt-4">
            <button class="btn btn-primary">{{ __('buttons.save') }}</button>
        </div>
    </block-editor>
@endsection
