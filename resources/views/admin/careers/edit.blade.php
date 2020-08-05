@extends('layouts.admin', ['page_title' => $careers->title])

@section('content')

    <block-editor action="{{ route('admin.careers.update', [$careers->id]) }}">
        @csrf
        @method('patch')

        @foreach(config('app.locales') as $locale)
        <fieldset slot="{{ $locale }}">
            <div class="form-group is-required{{ $errors->has('title') ? 'has-errors' : '' }}">
                <label for="title" class="form-label">{{ __('admin.careers.fields.title') }}</label>
                <input type="text" name="title[{{$locale}}]" class="form-control form-control-lg"
                    value="{{old('title.'.$locale) ?? $careers->getTranslation('title', $locale) }}">
            </div>

            <div class="form-group">
                <label for="description">{!! __('admin.careers.fields.description') !!}</label>
                <wysiwyg name="description[{{$locale}}]"
                    content="{{old('description.'.$locale) ?? $careers->getTranslation('description', $locale) }}">
                </wysiwyg>
            </div>
        </fieldset>
        @endforeach

        <div class="mt-4">
            <button class="btn btn-primary">{{ __('buttons.save') }}</button>
        </div>
    </block-editor>

@endsection
