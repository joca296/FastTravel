<nav class="col-2 bg-white sidebar">
    <div class="sidebar-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>List All</span>
        </h6>
        <ul class="nav flex-column">
            @foreach($listLinks as $listLink)
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == substr($listLink->link,1) ? 'active': ''}}" href="{{url('/').$listLink->link}}">{{$listLink->menuName}}</a>
                </li>
            @endforeach
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Insert</span>
        </h6>
        <ul class="nav flex-column">
            @foreach($insertLinks as $insertLink)
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == substr($insertLink->link,1) ? 'active': ''}}" href="{{url('/').$insertLink->link}}">{{$insertLink->menuName}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>