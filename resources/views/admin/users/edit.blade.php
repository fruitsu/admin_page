@extends('layouts.admin', ['page_title' => $user->name])
@section('content')

    <form action="{{ route('admin.users.update', [$user->id]) }}" method="post">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" class="form-label">{{ __('admin.users.fields.name') }}</label>
            <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name') ?? $user->name }}"
                   required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">{{ __('admin.users.fields.email.label') }}</label>
            <input type="text" class="form-control" value="{{ old('email') ?? $user->email }}" readonly>
            <div class="small text-muted">{{ __('admin.users.fields.email.placeholder') }}</div>
        </div>

        <div class="row">
            <div class="col-6">
                <password inline-template>
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('admin.users.fields.password.label') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <a href="#" class="input-group-text border-0" @click.prevent="switchType">
                                    <svg width="16" height="16">
                                        <use xlink:href="#icon--key"></use>
                                    </svg>
                                </a>
                            </div>
                            <input :type="type" name="password" class="form-control" v-model="password">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text border-0" @click.prevent="randomPassword">
                                    <svg width="16" height="16">
                                        <use xlink:href="#icon--dice"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="small text-muted">{{ __('admin.users.fields.password.placeholder') }}</div>
                    </div>
                </password>
            </div>

            <div class="col-6">
                <label for="role" class="form-label">{{ __('admin.users.fields.role') }}</label>
                <select name="role" id="role" class="form-control">
                    @foreach(trans('admin.users.roles') as $role => $title)
                        <option
                            value="{{ $role }}"
                            {{ $user->role === $role ? 'selected' : '' }}
                            {{ $user->id === Auth::user()->id ? 'disabled' : '' }}
                        >{{ $title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <button class="btn btn-primary">{{ __('buttons.save') }}</button>
            </div>

            @if ($user->id !== Auth::user()->id)
                <div class="col-auto">
                    <a href="{{ route('admin.users.destroy', [$user->id]) }}"
                       class="btn btn-danger"
                       onclick="event.preventDefault(); document.getElementById('delete-form').submit()">{{ __('buttons.delete') }}</a>
                </div>
            @endif
        </div>
    </form>

    <form action="{{ route('admin.users.destroy', [$user->id]) }}" id="delete-form" method="post" style="display: none">
        @csrf
        @method('delete')
    </form>

@endsection
