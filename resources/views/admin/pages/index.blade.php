@extends('layouts.admin', ['page_title' => __('admin.pages.title')])

@section('content')

    @component('components.admin.heading', ['route' => 'pages', 'button' => true, 'title' => 'admin.pages.title'])
    @endcomponent

    <table class="table">
        <thead>
        <tr>
            <th class="pl-0">{{ __('admin.pages.fields.title') }}</th>
            <th>{{ __('admin.pages.fields.slug') }}</th>
            <th width="100"></th>
        </tr>
        </thead>

        <tbody>
            @forelse($pages as $page)
                <tr>
                    <td class="pl-0">
                        <a href="{{ route('admin.pages.edit', [$page->slug]) }}" class="underline">
                            {{ $page->title }}

                        </a>
                    </td>

                    <td>/ {{ $page->slug }}</td>

                    @component('components.admin.manage', ['route' => 'pages', 'params' => $page->slug])
                    @endcomponent
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-3 text-center">{{ __('admin.not_found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pages->links() }}

    @includeWhen($pages->count(), 'partials.admin.deletion')

@endsection
