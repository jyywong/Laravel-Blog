@php
    $childPosts = App\Models\Post::where('replying_to_id', $post->id)->get();
@endphp
@if ($childPosts)
    @foreach ($childPosts as $post)
        @include('posts.components.postCardReplyComp',['colInt'=>$colInt])
            @if ( $post->id == $replyPost->id)
                <div class="row">
                    <div class="col-{{$colInt + 1}}">
                        <i class="ms-3 float-end" data-feather="corner-down-right"></i>
                    </div>
                    <div class="col">
                        <form action="{{route('postReply', [$board, $topic, $post])}}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <textarea type="text" class="form-control @error('postBody')is-invalid @enderror" placeholder="Your reply" name="postBody"></textarea>
                                <button class="btn btn-outline-success" type="submit" id="button-addon2">Submit</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            @endif
        @include('posts.components.postReplyRecursiveFx', ['colInt'=> ($colInt + 1)])
    @endforeach

@endif
