@extends('base')

@section('content')

<div class="container">
    <div class="container">
        <h2 >
            {{$query}}
        </h2>  
        <p class="text-muted"><small>Search results</small></p>
    </div>
    @if (!$results->isEmpty())
        @foreach ($results as $result)
        <div class="card m-2">
            <div class="card-body">
                <a href="{{route('posts', [$result->board, $result] )}}" style="text-decoration: none;color:inherit"><h5 class="card-title">{{$result->topic}}</h5></a>
                <p class="fw-bold mb-0" style="display: inline-block"><small>r/{{$result->board->name}} &middot;  </small></p> 
                <p class="text-muted" style="display: inline-block"><small> Posted by u/{{$result->OP()->user->name}}</small></p>
                <p class="text-muted" style="display: inline-block"><small> {{$result->OP()->created_at->diffforHumans()}}</small></p>
                {{-- <a href="{{route('postDetail', $post)}}" class="btn btn-primary">Read more</a> --}}
            </div>
            <div class="card-footer">
                @include('posts.components.postUpAndDownComp',['target'=>$result->OP(), 'board'=>$result->board, 'topic'=>$result])
                <a href="#" style="text-decoration: none;color: inherit">
                    <i data-feather="message-square" style="margin-left: 30px;"></i>
                    <small>{{($result->posts->count()-1) }} {{Str::plural('Comment', $result->posts->count()-1)}}</small>
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
            {{$results->withQueryString()->links()}}
        </div>
    @else
        <div class="card m-2">
            <div class="card-body">
                <h2>
                    There doesn't seem to be any thing matching your search.
                </h2>
            </div>
        </div>
    @endif
    
        
            
    
</div>
<script>
    feather.replace()
</script>
    
@endsection