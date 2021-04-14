@extends('base')

@section('content')

<div class="container">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
          </nav>
        
    </div>
    <div class="container">
        <h2>
            Boards
        </h2>
    </div>
    
        @foreach ($boards as $board)
            <div class="card m-2">
                <div class="card-body">
                   <a href="{{route('topic', $board)}}"> <h5 class="card-title">{{$board->name}}</h5></a>
                    <p class="card-text">{{$board->description}}</p>
                    {{-- <a href="{{route('postDetail', $post)}}" class="btn btn-primary">Read more</a> --}}
                </div>
            </div>
        @endforeach
            
    
</div>
    
@endsection