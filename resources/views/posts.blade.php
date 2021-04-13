@extends('base')

@section('content')
<div class="container">
    
        @foreach ($posts as $post)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="text-muted">{{$post->user->name}}</p>
                    <p class="card-text">{{$post->body}}}}</p>
                    <a href="{{route('postDetail', $post)}}" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach
            
    
</div>
@endsection