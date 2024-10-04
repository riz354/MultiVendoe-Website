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




        <form action="{{ route('import.brands') }}" id="teams-table-form" method="post">
            @csrf
            {{-- <form action="{{ route('storePreviewtest') }}" id="teams-table-form" method="get"> --}}
            {{ $dataTable->table() }}




        <div class="row mt-1">
            <div class="col"></div>
            <div class="col-lg-2 col-md-2 col-sm-12">
                <a href="{{ route('import.brands') }}"
                    class="btn w-100 btn-outline-danger waves-effect waves-float waves-light mb-2">
                    <i data-feather='x'></i>
                    {{ __('lang.commons.cancel') }}
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12">
                <button id="finalSubmit" type="submit"
                    class="btn btn-md w-100 btn-outline-success waves-effect waves-float waves-light buttonToBlockUI mb-1">
                    <i data-feather='save'></i>
                    Save
                </button>
            </div>
        </div>
    </form>


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



    <script></script>
@endsection
