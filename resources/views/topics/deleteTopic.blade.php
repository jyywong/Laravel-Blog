@extends('base')

@section('content')
<div class="container">
    <div class="card bg-light mb-4">
        <div class="col border-start ">
            <div class="card-header p-3">
                <h4>{{$topic->topic}}</h4>
            </div>
            <div class="card-body">
                <p class="text-muted">Posted by {{$OP->user->name}}</p>
                <p class="card-text">{!!clean($OP->body)!!}</p>
            </div>
            <div class="card-footer">
                @include('posts.components.postUpAndDownComp', ['target'=>$OP])
                @auth
                    @if (Auth::user()->id == $topic->OP()->user->id)
                        <a href="{{route('editTopic', [$board, $topic])}}" style="text-decoration: none;color: inherit">
                            <i data-feather="edit" style="margin-left: 30px"></i>
                            <small>Edit</small>
                        </a>
                        <a href="#" style="text-decoration: none;color: inherit">
                            <i data-feather="trash-2" style="margin-left: 30px"></i>
                            <small>Delete</small>
                        </a>
                    @endif
                @endauth
                
    
    
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
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
<script>
    feather.replace()
</script>
@endsection