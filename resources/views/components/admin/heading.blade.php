<header class="mb-4 row align-items-center">
    <h1 class="col h3 mb-0">{{ __($title ?? 'admin.'.$route.'.title') }}</h1>
    {{ $slot }}
    @if(isset($button) && $button)
        <div class="col-auto">
            <a href="{{ route('admin.'.$route.'.create') }}" class="btn btn-primary">
                <svg width="14" height="14" class="mr-2">
                    <use xlink:href="#icon--add"></use>
                </svg>
                {{ __('admin.'.$route.'.create.button') }}
            </a>
        </div>
    @endif
</header>
