@extends('base')

@section('content')
<div class="container">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('board')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('topic', $board)}}">{{$board->name}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$topic->topic}}</li>
            </ol>
          </nav>
    </div>
{{-- Original Post --}}
    @include('posts.components.postOPComp')
    @auth
        <form action="{{route('posts', [$board, $topic])}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <textarea readonly type="text" class="form-control @error('postBody')is-invalid @enderror" placeholder="Your reply" name="postBody"></textarea>
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Submit</button>
            </div>
        </form>
    @endauth
    @guest
    <div class="input-group mb-3">
        <textarea readonly type="text" class="form-control " placeholder="Log in or sign up to leave a comment" name="postBody"></textarea>
        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Login</button>
        <button class="btn btn-outline-success" type="submit" id="button-addon2">Sign up</button>
    </div>
    @endguest
{{-- End Original Post --}}
                
{{-- Replies --}}
    <div class="container">
        
        <h3>
            Replies
        </h3>
    </div>
            


    {{-- @if ($posts)
            @foreach ($posts as $post)
                @if ( $post->id == $replyPost->id)
                    <div class="card border-info mb-2" >
                        @include('posts.components.postCardComp')
                    </div>
                    <div class="row">
                        <div class="col-1">
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
                    
                @else
                    <div class="card mb-2" >
                        @include('posts.components.postCardComp')
                    </div>
                @endif
            
            @endforeach
    @endif --}}

    @if ($posts)
            @foreach ($posts as $post)
                @php
                    $colInt = 1
                @endphp
                @if ($post->replying_to_id == $OP->id | $post->replying_to_id == null)
                    <div class="card mb-2" >
                        @include('posts.components.postCardComp')
                    </div>
                    @if ( $post->id == $replyPost->id)
                        <div class="row">
                            <div class="col-1">
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
                    @include('posts.components.postReplyRecursiveFx', ['colInt' => $colInt])
                    
                @endif
            @endforeach
            
    @endif
        
            
    
</div>
{{-- End replies --}}
<script>
    feather.replace()
</script>
@endsection