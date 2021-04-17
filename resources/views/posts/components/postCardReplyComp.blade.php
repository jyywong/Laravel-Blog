

<div class="row">
    <div class="col-{{$colInt}}">
        <i class="ms-3 float-end" data-feather="corner-down-right"></i>
    </div>
    <div class="col">
        <div class="card mb-2" >
            <div class="card-body">
                <p class="fw-lighter my-0 " style="display: inline-block"><small>Posted by {{$post->user->name}}</small></p>
                <p class="text-muted text-sm mx-2 my-0" style="display: inline-block"><small>{{$post->created_at->diffforHumans()}}</small></p>
                <p class="card-text">{{$post->body}}</p>
            
            </div>
            <div class="card-footer">
                @include('posts.components.postUpAndDownComp', ['target'=>$post])
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
    </div>
    
</div>