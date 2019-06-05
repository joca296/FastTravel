@include('include.head')
@include('include.nav')

<div class="container">
    @include('include.slider')

    @include('include.message')
    @include('include.error')

    @yield('content')
</div>

@include('include.jsInclude')
@yield('js')

@include('include.footer')