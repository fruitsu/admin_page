<aside id="app-aside" v-scrollbar>
    <nav>
        <ul class="list-unstyled mb-0 mh-100 accordion">
            @foreach(app('nav')->backend() as $nav)
                <li id="submenu-heading-{{ $loop->iteration }}"
                    class="nav-item{{ $nav->match ? ' is-active' : '' }}">
                    @isset($nav->unread)
                        <div class="unread">{{ $nav->unread }}</div>
                    @endisset

                    @if (empty($nav->children))
                        <a href="{{ $nav->route }}" class="d-flex align-items-center">
                            <i class="nav-icon {{ $nav->icon }} mr-3"></i>
                            <span class="nav-link">{{ $nav->name }}</span>
                        </a>
                    @else
                        <a href="{{ $nav->route }}" class="d-flex align-items-center">
                            <i class="nav-icon {{ $nav->icon }} mr-3"></i>
                            <span class="nav-link">{{ $nav->name }}</span>
                        </a>
                        <ul class="collapse list-unstyled submenu{{ $nav->match ? ' show' : '' }}">
                            @foreach($nav->children as $child)
                                <li class="submenu-item">
                                    <a href="{{ $child->route }}">
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</aside>
