@extends('layouts.admin', ['page_title' => __('admin.careers.title')])

@section('content')

    @component('components.admin.heading', ['route' => 'careers', 'title' => 'admin.careers.title', 'button' => true])
    @endcomponent

    <table class="table">
        <thead>
        <tr>
            <th class="pl-0">{{ __('admin.careers.fields.title') }}</th>
            <th width="100"></th>
        </tr>
    </thead>

        <tbody>
        @forelse($careers as $career)
            <tr>
            <td class="pl-0">
                <a href="{{ route('admin.careers.edit', $career->id) }}" class="underline">
                    {{ $career->title }}
                </a>
            </td>

                @component('components.admin.manage', ['route' => 'careers', 'params' => $career])
                @endcomponent
            </tr>
        @empty
            <tr>
                <td colspan="3" class="py-3 text-center">{{ __('admin.not_found') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $careers->links() }}

    @includeWhen($careers->count(), 'partials.admin.deletion')

@endsection
