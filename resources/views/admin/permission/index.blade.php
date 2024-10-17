@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('page-css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.7.0/css/autoFill.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.0/css/buttons.bootstrap5.min.css">
    {{-- <script src="https://cdn.tailwindcss.com" ></script> --}}
@endsection

@section('content')
    <div class="content-wrapper">



        <table class="w-100">
            <tr class="btg-gray" style="">
                <th>#</th>
                <th>Title</th>
            </tr>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->show_name}}</td>
            </tr>
            @endforeach

        </table>
        {!! $permissions->links() !!}




    </div>
@endsection

@section('page-js')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables Server-Side Processing -->
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <!-- DataTables Initialization Script -->
    {{-- {!! $dataTable->scripts() !!} --}}


    <script>

    </script>
@endsection
