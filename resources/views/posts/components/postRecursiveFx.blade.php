@php
    $childPosts = App\Models\Post::where('replying_to_id', $post->id)->get();
@endphp
@if ($childPosts)
    @foreach ($childPosts as $post)
        @include('posts.components.postCardReplyComp',['colInt'=>$colInt])
        @include('posts.components.postRecursiveFx', ['colInt'=> ($colInt + 1)])
    @endforeach

@endif
