@if(Auth::check())
    <form action="{{url('/')}}/user/logout" method="POST" class="form-inline my-2 my-lg-0">
        @csrf
        <label class="navbar-text mr-2" style="margin-bottom: 0px;">{{Auth::user()->firstName}}&nbsp;{{Auth::user()->lastName}}</label>
        <button type="submit" class="btn btn-outline-danger mr-2" name="btnLogout">Log Out</button>
    </form>
@endif
@if(!Auth::check())
    <form action="{{url('/')}}/user/login" method="POST" class="form-inline my-2 my-lg-0">
        @csrf
        <input type="text" class="form-control mr-2" placeholder="E-mail Address" name="eMail">
        <input type="password" class="form-control mr-2" placeholder="Password" name="password">
        <button type="submit" class="btn btn-outline-primary mr-2" name="btnLogin">Log In</button>
    </form>
@endif
@if(session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 0px;">
        <span>{{session()->get('loginError')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php session()->forget('loginError');?>
    </div>
@endif