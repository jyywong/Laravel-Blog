<div class="card m-2">
    <div class="card-body">
        <a href="{{route('filterTopics', [$board, 'hot'])}}" class="btn @if($filter == 'hot')btn-dark @else btn-outline-dark @endif " style="border: none">
            <i data-feather="trending-up" style="display: inline"></i>
            <h5 style="display: inline">Hot</h5>
        </a>
        <a href="{{route('filterTopics', [$board, 'new'])}}" class="btn @if($filter == 'new')btn-dark @else btn-outline-dark @endif" style="border: none">
            <i data-feather="hexagon" style="display: inline"></i>
            <h5 style="display: inline">New</h5>
        </a>
        <a href="{{route('filterTopics', [$board, 'top'])}}" class="btn @if($filter == 'top')btn-dark @else btn-outline-dark @endif" style="border: none">
            <i data-feather="award" style="display: inline"></i>
            <h5 style="display: inline">Top</h5>
        </a>
        
        

    </div>
</div>