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

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Offcanvas right</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h5 id="" class="text-center">Exports Columns Name</h5>
                <div class="mb-1">
                    <input type="hidden" value="brands" id="export_document_type" name="document_type"
                        id="export_document_type">
                    @foreach (config('user-export.brands') as $key => $value)
                        <input type="checkbox" value="{{ $value }}" class="filter_status_active"
                            name="{{ $key }}" class="form-check-input" checked>
                        <label for="{{ $key }}">{{ $value }}</label><br>
                    @endforeach
                </div>


                <div class="mb-1 text-center">
                    <button onclick="ExportCsv(this)" file_name="brands" file_type="csv"
                        class="btn btn-primary btn-lg">Export Csv</button>
                </div>
                <div class="mb-1 text-center">
                    <button onclick="Exportxl(this)" file_name="brands" file_type="xlsx"
                        class="btn btn-danger btn-lg">Export xlsx</button>
                </div>
            </div>
        </div>
        <button class="btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight">Export</button>

        <a href="{{ route('admin.catelogue.brand.create') }}"><button class="btn btn-primary mb-3"
                style="margin-left:95%">Add New</button></a>
        {{ $dataTable->table() }}
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
    {!! $dataTable->scripts() !!}



    <script>
        function ExportCsv(elem) {
            var file_name = elem.getAttribute('file_name');
            var file_type = elem.getAttribute('file_type');

            var headings = [];

            $('.filter_status_active').each(function() {
                if ($(this).is(':checked')) {
                    headings.push($(this).attr('name'))
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('export-system') }}",
                data: {
                    'file_name': file_name,
                    'file_type': file_type,
                    'headings': headings,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success:function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "File is exporting in background",
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error:function(response) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        footer: '<a href="#">Why do I have this issue?</a>'
                    });
                }
            })
        }


        function Exportxl(elem) {
            var file_name = elem.getAttribute('file_name');
            var file_type = elem.getAttribute('file_type');

            var headings = [];

            $('.filter_status_active').each(function() {
                if ($(this).is(':checked')) {
                    headings.push($(this).attr('name'))
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('export-system-xl') }}",
                data: {
                    'file_name': file_name,
                    'file_type': file_type,
                    'headings': headings,
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success:function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "File is exporting in background",
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error:function(response) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        footer: '<a href="#">Why do I have this issue?</a>'
                    });
                }
            })
        }
    </script>
@endsection
