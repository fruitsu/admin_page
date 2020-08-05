@php
  $metas = $metas ?? null;
@endphp

<div class="mt-4">
    @if (request()->is('*/create'))
        <div class="text-muted small mb-2">
            <sup>*</sup>
            {{ __('admin.meta.warning') }}
        </div>
    @endif

    <div class="form-group{{ $errors->has('meta.title') ? ' has-errors' : '' }}">
        <label for="title" class="form-label">{{ __('admin.meta.fields.title') }}</label>
        <input type="text" name="meta[title][{{$locale}}]" class="form-control"
               value="{{ old('meta.title.'.$locale) ?? optional($metas)->getTranslation('title', $locale) }}">
    </div>

    <div class="form-group{{ $errors->has('meta.description') ? ' has-errors' : '' }}">
        <label for="description" class="form-label">{{ __('admin.meta.fields.description') }}</label>
        <textarea name="meta[description][{{$locale}}]" rows="4"
                  class="form-control">{{ old('meta.description.'.$locale) ?? optional($metas)->getTranslation('description', $locale) }}</textarea>
    </div>
</div>
