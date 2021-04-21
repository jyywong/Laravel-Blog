@extends('base')

@section('content')
<div class="container">
    <h3>Notifications </h3>
</div>
    @foreach ($notifications as $notification)
        <div class="container">
            <div class="card">
                <div class="card-header p-3">
                    <h5>u/{{$notification->data['replyer']['name']}} replied to one of your posts in r/{{App\Models\Post::find($notification->data['post']['id'])->topic->board->name}}</h5>
                </div>
                <div class="card-body ps-3 p-2">
                    <p class="fw-lighter my-0 " style="display: inline-block"><small>Posted by u/{{$notification->data['replyer']['name']}}</small></p>
                    <p class="text-muted text-sm mx-2 my-0" style="display: inline-block"><small>{{App\Models\Post::find($notification->data['post']['id'])->created_at->diffforHumans()}}</small></p>
                    <p class="card-text">
                        {!!clean($notification->data['post']['body'])!!}
                    </p>
    
                </div>
            </div>
            
        </div>
        @php
            $notification->markAsRead();
        @endphp
    
    @endforeach
    <div class="container justify content-center mt-2">
        {{$notifications->withQueryString()->links()}}
    </div>

@endsection