<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{url('/')}}/">Fast Travel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            @foreach($menu as $menuItem)
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == substr($menuItem->link,1) ? 'active': ''}}" href="{{$menuItem->externLink==1? $menuItem->link : url('/').$menuItem->link}}">{{$menuItem->menuName}}</a>
                </li>
            @endforeach
            @if(Auth::check())
                <li class="nav-item dropdown {{strstr(Request::path(),'user')? 'active' : ''}}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User Tools</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($userLinks as $userLink)
                            <a class="dropdown-item" href="{{url('/').$userLink->link}}">{{$userLink->menuName}}</a>
                        @endforeach
                    </div>
                </li>
                @if(Auth::user()->admin == 1)
                    <li class="nav-item">
                        <a class="nav-link {{strstr(Request::path(),'admin')? 'active' : ''}}" href="{{url('/')}}/admin">Admin Panel</a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
    @include('include.login')
</nav>
