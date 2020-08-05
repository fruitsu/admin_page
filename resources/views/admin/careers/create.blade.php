@extends('layouts.admin', ['page_title' => __('admin.careers.create.title')])

@section('content')
    <block-editor action="{{ route('admin.careers.store') }}">
        @csrf

        @foreach(config('app.locales') as $locale)
            <fieldset slot="{{ $locale }}">
                <div class="form-group is-required{{ $errors->has('title') ? 'has-errors' : '' }}">
                    <label for="title" class="form-label">{{ __('admin.careers.fields.title') }}</label>
                    <input type="text" name="title[{{$locale}}]" class="form-control form-control-lg"
                           value="{{ old('title.'.$locale) }}">
                </div>

                <div class="form-group is-required{{ $errors->has('description') ? 'has-errors' : '' }}">
                    <label for="description" class="form-label">{{ __('admin.careers.fields.description') }}</label>
                    <wysiwyg name="description[{{$locale}}]" content="{{ old('description.'.$locale) }}"></wysiwyg>
                </div>
            </fieldset>
        @endforeach
        <div class="mt-4">
            <button class="btn btn-primary">{{ __('buttons.save') }}</button>
        </div>
    </block-editor>
@endsection
