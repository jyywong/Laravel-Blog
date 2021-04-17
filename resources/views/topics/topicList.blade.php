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
                <p class="text-muted mb-0"><small>Posted by u/{{$topic->OP()->user->name}} {{$topic->OP()->created_at->diffforHumans()}}</small></p>
                <a href="{{route('posts', [$board, $topic] )}}" style="text-decoration: none;color:inherit"><h5 class="card-title">{{$topic->topic}}</h5></a>
                <p class="text-muted mb-0"><small>{{strip_tags($topic->OP()->body)}} </small></p>
            </div>
            <div class="card-footer">
                @include('posts.components.postUpAndDownComp',['target'=>$topic->posts->where('topic_id', $topic->id)->where('isOP', true)[0]])
                <a href="{{route('posts', [$board, $topic] )}}" style="text-decoration: none;color: inherit">
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
        <div class="container justify content-center">
            {{$topics->withQueryString()->links()}}
        </div>
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