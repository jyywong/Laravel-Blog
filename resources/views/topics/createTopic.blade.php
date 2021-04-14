@extends('base')

@section('content')
<div class="container">
    <h3>
        Create a topic in {{$board->name}}
    </h3>
    <div class="container">
        <form action="{{route('createTopic', $board)}}" method="post" >
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Topic Name</label>
                <input name="topicTopic" type="text" class="form-control @error('topicTopic') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Title">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Topic body</label>
                <textarea name="topicBody" class="form-control @error('topicBody') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" placeholder="Your post"></textarea>
                </div>
            </div>
            <div class="container">
                <div class="d-grid">
                    <button class="btn btn-success">Submit</button>
                </div>
            </div>
        
            
        </form>
    </div>
    
    
</div>

@endsection