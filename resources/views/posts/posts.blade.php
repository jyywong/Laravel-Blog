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
    <div class="container">
    
    </div>
            <div class="card bg-light mb-4">
                <div class="card-header p-3">
                    <h4>{{$topic->topic}}</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Posted by {{$OP->user->name}}</p>
                    <p class="card-text">{{$OP->body}}</p>
                   
                </div>
            </div>


                <form action="{{route('posts', [$board, $topic])}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <textarea type="text" class="form-control @error('postBody')is-invalid @enderror" placeholder="Your reply" name="postBody"></textarea>
                        <button class="btn btn-outline-success" type="submit" id="button-addon2">Submit</button>
                      </div>
                </form>




            <div class="container">
                <h3>
                    Replies
                </h3>
            </div>
            

        @if ($posts)
            @foreach ($posts as $post)
            <div class="card mb-2">
                <div class="card-body">
                    <p class="fw-lighter my-0 " style="display: inline-block"><small>Posted by {{$post->user->name}}</small></p>
                    <p class="text-muted text-sm mx-2 my-0" style="display: inline-block"><small>{{$post->created_at->diffforHumans()}}</small></p>
                    <p class="card-text">{{$post->body}}</p>
                
                </div>
            </div>
            @endforeach
        @endif
        
            
    
</div>
@endsection