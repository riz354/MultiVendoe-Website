@include('live.layout.header')


    <!-- Navbar Start -->
 @include('live.layout.navbar')
    <!-- Navbar End -->


  @yield('content')
    <!-- Footer Start -->
   @include('live.layout.footer')
    <!-- Footer End -->


@include('live.layout.scripts')
@yield('page-js')

</body>

</html>
