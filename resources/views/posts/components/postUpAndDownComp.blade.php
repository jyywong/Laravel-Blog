<form action="{{route('postLike', [$board, $topic, $target])}}" method="post" style="display: inline">
    @csrf
    <button class="btn p-0" type="submit">
        <i 
            @if (Auth::user()->hasLikedPost($target->id))
                stroke="blue" 
            @endif
        data-feather="arrow-up"></i>
    </button>
</form>
<small class="mx-2">{{$target->totalUpvotes()}}</small>
<form action="{{route('postDislike', [$board, $topic, $target])}}" method="post" style="display: inline">
    @csrf
    <button class="btn p-0" type="submit">
        <i 
            @if (Auth::user()->hasDislikedPost($target->id))
            stroke="red"
            @endif
        data-feather="arrow-down"></i>
    </button>
</form>