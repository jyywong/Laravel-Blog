@extends('base')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header p-4">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="text-muted">{{$post->user->name}}</p>
        </div>
        <div class="card-body p-4" style="height: 50rem">
           
            <p class="card-text">{{$post->body}}</p>

        </div>
    </div>
</div>
@endsection