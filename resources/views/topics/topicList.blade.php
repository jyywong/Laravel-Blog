@extends('base')

@section('content')

<div class="container">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('board')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$board->name}}</li>
            </ol>
          </nav>
    </div>
    <div class="container">
        <h2 >
            {{$board->name}}
            
        </h2>
        <a href="{{route('createTopic', $board)}} "class="btn btn-success ">Create a topic</a>
       
    </div>
    @if (!$topics->isEmpty())
        @foreach ($topics as $topic)
        <div class="card m-2">
            <div class="card-body">
                <a href="{{route('posts', [$board, $topic] )}}"><h5 class="card-title">{{$topic->topic}}</h5></a>
                {{-- <a href="{{route('postDetail', $post)}}" class="btn btn-primary">Read more</a> --}}
            </div>
        </div>
        @endforeach
    @else
        <div class="card m-2">
            <div class="card-body">
                <h2>
                    There doesn't seem to be any topics in this board.
                </h2>
            </div>
        </div>
    @endif
    
        
            
    
</div>
    
@endsection