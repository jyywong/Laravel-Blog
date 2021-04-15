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
                <div class="col border-start ">
                    <div class="card-header p-3">
                        <h4>{{$topic->topic}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Posted by {{$OP->user->name}}</p>
                        <p class="card-text">{{$OP->body}}</p>
                    </div>
                    <div class="card-footer">
                        <form action="{{route('postLike', [$board, $topic, $OP])}}" method="post" style="display: inline">
                            @csrf
                            <button class="btn p-0" type="submit">
                                <i stroke="blue" data-feather="arrow-up"></i>
                            </button>
                        </form>
                        <small class="mx-2"> {{$OP->likes()->count()}}</small>
                        <form action="{{route('postLike', [$board, $topic, $OP])}}" method="post" style="display: inline">
                            @csrf
                            @method('delete')
                            <button class="btn p-0" type="submit">
                                <i stroke="red" data-feather="arrow-down"></i>
                            </button>
                        </form>
                          
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
            </div>
            @auth
                <form action="{{route('posts', [$board, $topic])}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <textarea type="text" class="form-control @error('postBody')is-invalid @enderror" placeholder="Your reply" name="postBody"></textarea>
                        <button class="btn btn-outline-success" type="submit" id="button-addon2">Submit</button>
                    </div>
                </form>
            @endauth
            @guest
            <div class="input-group mb-3">
                <textarea readonly type="text" class="form-control " placeholder="Log in or sign up to leave a comment" name="postBody"></textarea>
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Login</button>
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Sign up</button>
            </div>
            @endguest
                




            <div class="container">
                
                <h3>
                    Replies
                </h3>
            </div>
            


        @if ($posts)
            @foreach ($posts as $post)

            <div class="card mb-2" >
                <div class="card-body">
                    <p class="fw-lighter my-0 " style="display: inline-block"><small>Posted by {{$post->user->name}}</small></p>
                    <p class="text-muted text-sm mx-2 my-0" style="display: inline-block"><small>{{$post->created_at->diffforHumans()}}</small></p>
                    <p class="card-text">{{$post->body}}</p>
                
                </div>
                <div class="card-footer">
                    <form action="{{route('postLike', [$board, $topic, $post])}}" method="post" style="display: inline">
                        @csrf
                        <button class="btn p-0" type="submit">
                            <i stroke="blue" data-feather="arrow-up"></i>
                        </button>
                    </form>
                    <small class="mx-2"> {{$post->likes()->count()}}</small>
                    <form action="{{route('postLike', [$board, $topic, $post])}}" method="post" style="display: inline">
                        @csrf
                        @method('delete')
                        <button class="btn p-0" type="submit">
                            <i stroke="red" data-feather="arrow-down"></i>
                        </button>
                    </form>
                    <a href="{{route('postReply', [$board, $topic, $post])}}" style="text-decoration: none;color: inherit">
                        <i data-feather="message-square" style="margin-left: 30px; width:16px; height:16px;"></i>
                        <small>Reply</small>
                    </a>
                    <a href="#" style="text-decoration: none;color: inherit">
                        <i data-feather="share-2" style="margin-left: 30px; width:16px; height:16px;"></i>
                        <small>Share</small>
                    </a>
                    <a href="#" style="text-decoration: none;color: inherit">
                        <i data-feather="flag" style="margin-left: 30px; width:16px; height:16px;"></i>
                        <small>Report</small>
                    </a>
                    
                </div>
            </div>
            @endforeach
        @endif
        
            
    
</div>
<script>
    feather.replace()
</script>
@endsection