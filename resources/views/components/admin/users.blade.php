<td width="80">
    <div class="d-flex text-center">
        <form action="{{ route('admin.'.$route.'.users', [$model, 'up']) }}" method="post" class="col-6 px-0">
            @csrf
            <button class="btn btn-sm p-0">&uparrow;</button>
        </form>

        <form action="{{ route('admin.'.$route.'.users', [$model, 'down']) }}" method="post" class="col-6 px-0">
            @csrf
            <button class="btn btn-sm p-0">&downarrow;</button>
        </form>
    </div>

    <div class="d-flex text-center">
        <form action="{{ route('admin.'.$route.'.users', [$model, 'start']) }}" method="post" class="col-6 px-0">
            @csrf
            <button class="btn p-0">&uuarr;</button>
        </form>

        <form action="{{ route('admin.'.$route.'.users', [$model, 'end']) }}" method="post" class="col-6 px-0">
            @csrf
            <button class="btn p-0">&ddarr;</button>
        </form>
    </div>
</td>
