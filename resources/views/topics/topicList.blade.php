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

        <h2 style="display: inline-block">
            {{$board->name}}
            
        </h2>

        @auth

            <form style="display: inline-block"  class="px-3" action="{{route('joinBoard', $board)}}" method="post">
                @csrf
                @if ($board->users->contains(Auth::user()->id))
                    <button class="btn btn-danger mb-3"> Leave </button>
                @else
                    <button class="btn btn-primary mb-3"> Join </button>
                @endif
                
                <a  href="{{route('createTopic', $board)}} " class="btn btn-success ms-2 mb-3 ">Create a topic</a>
            </form>



        
        
        @endauth
        
       
    </div>
    
    <div class="row">
        <div class="col-8">
            @include('topics.topicFilterComp')
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
        <div class="col p-0">
            <div class="card mt-2">
                <div class="card-header">
                    About community
                </div>
                <div class="card-body">
                    {{$board->description}}
                    <hr>
                    <div class="row ps-2">
                        <div class="col">
                            <h5>{{$board->users->count()}}</h5>
                            <p class="text-muted"> Members </p>
                        </div>
                        <div class="col">
                            <h5>{{$board->topics->count()}}</h5>
                            <p class="text-muted"> Threads </p>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="container justify content-center">
            {{$topics->withQueryString()->links()}}
        </div>
    </div>
    
    
    
    
        
            
    
</div>
<script>
    feather.replace()
</script>
    
@endsection