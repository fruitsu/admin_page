@extends('layouts.admin', ['page_title' => __('admin.portfolios.title')])

@section('content')

    @component('components.admin.heading', ['route' => 'portfolios' ,'button' => true, 'title' => 'admin.portfolios.title'])
    @endcomponent

    <table class="table">
        <thead>
        <tr>
            <th class="pl-0">{{ __('admin.portfolios.fields.title') }}</th>
            <th>{{ __('admin.portfolios.fields.slug') }}</th>
            <th width="100"></th>
        </tr>
        </thead>

        <tbody>
            @forelse($portfolios as $portfolio)
                <tr>
                    <td class="pl-0">
                        <a href="{{ route('admin.portfolios.edit', [$portfolio->slug]) }}" class="underline">
                            {{ $portfolio->title }}

                        </a>
                    </td>

                    <td>/ {{ $portfolio->slug }}</td>

                    @component('components.admin.manage', ['route' => 'portfolios', 'params' => $portfolio->slug])
                    @endcomponent
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-3 text-center">{{ __('admin.not_found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $portfolios->links() }}

    @includeWhen($portfolios->count(), 'partials.admin.deletion')

@endsection
