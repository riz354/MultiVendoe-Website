@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('page-css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.7.0/css/autoFill.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.0/css/buttons.bootstrap5.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <a href="{{route('admin.catelogue.categories.create')}}"><button class="btn btn-primary mb-3" style="margin-left:95%">Add New</button></a>
        {{ $dataTable->table() }}
    </div>
@endsection

@section('page-js')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.html5.min.js"></script> --}}

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables Server-Side Processing -->
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    <!-- DataTables Initialization Script -->
    {!! $dataTable->scripts() !!}
@endsection







{{--
Swal.fire({
    icon: 'warning',
    title: 'Confirmation',
    text: 'Are you sure to Import File',
    confirmButtonText: 'Yes',
    cancelButtonText: '{{ __('lang.commons.no_cancel') }}',
    showCancelButton: true,
    buttonsStyling: false,
    customClass: {
        confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
        cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
    },
}).then((result) => {
    if (result.isConfirmed) {
        $('#teams-table-form').submit();
    }
}); --}}
