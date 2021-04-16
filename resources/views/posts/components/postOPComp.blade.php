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
            @include('posts.components.postUpAndDownComp', ['target'=>$OP])
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