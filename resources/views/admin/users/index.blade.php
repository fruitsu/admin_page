@extends('layouts.admin', ['page_title' => __('admin.users.title')])

@section('content')

    @component('components.admin.heading', ['route' => 'users', 'title' => 'admin.users.title', 'button' => true])
    @endcomponent

    <table class="table">
        <thead>
        <tr>
            <th class="pl-0">{{ __('admin.users.fields.name') }}</th>
            <th width="240">{{ __('admin.users.fields.email.label') }}</th>
            <th width="100">{{ __('admin.users.fields.role') }}</th>
            <th width="100" class="nobr">{{ __('admin.users.fields.created_at') }}</th>
            <th width="100"></th>
        </tr>
        </thead>

        <tbody>
        @forelse($users as $user)
            <tr>
                <td class="pl-0">
                    <a href="{{ route('admin.users.edit', [$user->id]) }}" class="underline">
                        {{ $user->name }}
                    </a>
                </td>
                <td><a href="mailto:{{ $user->email }}" class="dashed">{{ $user->email }}</a></td>
                <td>{{ __('admin.users.roles.'.$user->role) }}</td>
                <td class="nobr">{{ $user->created_at->format('d.m.Y H:i') }}</td>

                @component('components.admin.manage', ['route' => 'users', 'params' => $user->id, 'except' => [$user->id === Auth::user()->id ? 'destroy' : '']])
                @endcomponent
            </tr>
        @empty
            <tr>
                <td colspan="3" class="py-3 text-center">{{ __('admin.not_found') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $users->links() }}

    @includeWhen($users->count(), 'partials.admin.deletion')

@endsection
