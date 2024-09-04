@include('admin.layout.header')

<div class="container-scroller">
    @include('admin.layout.navbar')

    <div class="container-fluid page-body-wrapper">
        @include('admin.layout.leftnav')

        <div class="main-panel">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close ml-auto" data-bs-dismiss="alert" aria-label="Close" style="display: flex;margin-left: auto;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show b-none d-flex justify-content-between align-items-center b-none" role="alert">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show b-none d-flex justify-content-between align-items-center b-none" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @yield('content')

            <!-- Footer -->
            @include('admin.layout.footer')
        </div>
    </div>
</div>

<!-- Scripts -->
@include('admin.layout.scripts')
@yield('page-js')

</body>
</html>
