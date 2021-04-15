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
        @auth
        <a href="{{route('createTopic', $board)}} "class="btn btn-success ">Create a topic</a>
        @endauth
        
       
    </div>
    @if (!$topics->isEmpty())
        @foreach ($topics as $topic)
        <div class="card m-2">
            <div class="card-body">
                <a href="{{route('posts', [$board, $topic] )}}" style="text-decoration: none;color:inherit"><h5 class="card-title">{{$topic->topic}}</h5></a>
                <p class="text-muted"><small>{{$topic->posts->where('topic_id', $topic->id)->where('isOP', true)[0]->body}} </small></p>
                {{-- <a href="{{route('postDetail', $post)}}" class="btn btn-primary">Read more</a> --}}
            </div>
            <div class="card-footer">
                <a href="#" style="text-decoration: none;color: inherit">
                <i stroke="blue" data-feather="arrow-up"></i>
                </a>
                
                <small class="mx-2"> {{$topic->posts->where('topic_id', $topic->id)->where('isOP', true)[0]->likes->count()}} </small>
                <a href="#" style="text-decoration: none;color: inherit">
                <i stroke="red" data-feather="arrow-down"></i>
                </a>
                <a href="#" style="text-decoration: none;color: inherit">
                    <i data-feather="message-square" style="margin-left: 30px;"></i>
                    <small>{{($topic->posts->count()-1) }} {{Str::plural('Comment', $topic->posts->count()-1)}}</small>
                </a>
                <a href="#" style="text-decoration: none;color: inherit">
                    <i data-feather="share-2" style="margin-left: 30px"></i>
                    <small>Share</small>
                </a>
                <a href="#" style="text-decoration: none;color: inherit">
                    <i data-feather="flag" style="margin-left: 30px"></i>
                    <small>Report</small>
                </a>
                
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
<script>
    feather.replace()
</script>
    
@endsection