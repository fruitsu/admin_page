<td class="pr-0">
    <div class="text-center text-sm-right">
        {{ $slot }}

        <a href="{{ route('admin.'.$route.'.edit', is_array($params) ? $params : [$params]) }}"
           class="btn btn-primary btn-round">
            <svg width="14" height="14">
                <use xlink:href="#icon--edit"></use>
            </svg>
        </a>

        @if (empty($except) || !in_array('destroy', $except))
            <a href="{{ route('admin.'.$route.'.destroy', is_array($params) ? $params : [$params]) }}"
               class="btn btn-danger btn-round"
               onclick="deleteItem()">
                <svg width="14" height="14">
                    <use xlink:href="#icon--delete"></use>
                </svg>
            </a>
        @endif
    </div>
</td>
