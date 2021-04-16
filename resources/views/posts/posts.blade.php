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
        @include('posts.components.postOPComp')
        @auth
            <form action="{{route('posts', [$board, $topic])}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <textarea type="text" class="form-control @error('postBody')is-invalid @enderror" placeholder="Your reply" name="postBody"></textarea>
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
            

        <div class="container">
            
            <h3>
                Replies
            </h3>
        </div>
            

        {{-- Working code --}}
        {{-- @if ($posts)
            @foreach ($posts as $post)
                <div class="card mb-2" >
                    @include('posts.components.postCardComp')
                </div>
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
                    @include('posts.components.postRecursiveFx', ['colInt' => $colInt])
                    
                @endif
            @endforeach
            
        @endif
        
            
    
</div>
<script>
    feather.replace()
</script>
@endsection