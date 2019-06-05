@include('include.head')
@include('include.nav')

<div class="container-fluid">
    <div class="row">
        @include('include.adminNav')

        <div class="col-10 content">
            @include('include.message')
            @include('include.error')

            @yield('content')
        </div>
    </div>
</div>

@include('include.jsInclude')
@yield('js')

@include('include.footer')