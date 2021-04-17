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
                    {{-- <a href="{{route('deleteTopic', [$board, $topic])}}" style="text-decoration: none;color: inherit">
                        <i data-feather="trash-2" style="margin-left: 30px"></i>
                        <small>Delete</small>
                    </a> --}}
                    <!-- Button trigger modal -->
                <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i data-feather="trash-2" style="margin-left: 30px"></i>
                        <small>Delete</small>
                </button>
                @endif
            @endauth
                <button class="btn p-0" onclick="copyToClipboard()">
                    <i data-feather="share-2" style="margin-left: 30px"></i>
                    <small>Share</small>
                </button>
                    

                <a href="#" style="text-decoration: none;color: inherit">
                    <i data-feather="flag" style="margin-left: 30px"></i>
                    <small>Report</small>
                </a>
            
            
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete post?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete your post? You can't undo this.
        </div>
        <div class="modal-footer">
            <form action="{{route('deleteTopic', [$board, $topic])}}" method="post">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete post</button>
            </form>
          
        </div>
      </div>
    </div>
  </div>

  <script>
    function copyToClipboard(text){
        var inputc = document.body.appendChild(document.createElement("input"))
        inputc.value = window.location.href
        inputc.focus()
        inputc.select()
        document.execCommand('copy')
        inputc.parentNode.removeChild(inputc)
        bootstrap.Alert.getInstance(alert('URL Copied!'))
      }
  </script>