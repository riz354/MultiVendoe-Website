@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('page-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@endsection

@section('content')
    <div class="content-wrapper" style="display:flex;justify-content:center">

        <form style="width:50%;" class="mt-5" action="{{ route('admin.update', ['id' => $admin->id]) }}"
            method="POST">
            @csrf
            <h1 class="text-center">Edit</h1>

            @include('admin.admin.form-fields')

            <button type="submit" class="btn btn-primary" style="margin-left: 90%">Submit</button>
        </form>
    </div>
@endsection

@section('page-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


<script>


</script>

@endsection
