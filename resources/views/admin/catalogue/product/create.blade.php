@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('page-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@endsection

@section('content')
    <div class="content-wrapper" style="display:flex;justify-content:center">

        <form style="width:50%;" class="mt-5" action="{{ route('admin.catelogue.categories.store') }}" method="POST">
            @csrf
            <h1 class="text-center">Create</h1>
            @include('admin.catalogue.product.form-fields')
            <button type="submit" class="btn btn-primary" style="margin-left: 90%">Submit</button>
        </form>
    </div>
@endsection

@section('page-js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            FilePond.registerPlugin(
                FilePondPluginImagePreview
            );

            var files = [];
            @if (isset($attachments))
                @forelse($attachments as $image)

                    files.push({
                        source: '{{ $image->getUrl() }}',
                    });
                @empty
                @endforelse
            @endif
            FilePond.create(document.getElementById('file'), {
                files: files,
                styleButtonRemoveItemPosition: 'right',
                allowImagePreview: true,
                // imageValidateSizeMinWidth: 1000,
                // imageValidateSizeMinHeight: 1000,
                imageCropAspectRatio: '1:1',
                // acceptedFileTypes: ['image/png', 'image/jpeg', 'image/gif', 'application/pdf'],
                maxFileSize: '100000KB',
                // ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
                storeAsFile: false,
                allowMultiple: true,
                maxFiles: 3,
                // required: true,
                checkValidity: true,
                chunkUploads: true,
                chunkSize: '200KB',
                chunkForce: true,
                server: {
                    timeout: 7000,
                    process: '/files/getUploadId',
                    revert: '/files/revertFile',
                    patch: '/files/uploadfileChunk?patch=',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                credits: {
                    label: '',
                    url: ''
                }
            });



            $('#section_id').on('change',function(){
                let section_id = $('#section_id').val();
                // alert(section_id)

                if(section_id > 0)

                $.ajax({
                    type:'post',
                    url:'{{route('admin.catelogue.product.append-categories')}}',
                    data:{
                        'section_id':section_id
                    },
                    headers:{
                        'X-CSRF-Token':'{{csrf_token()}}'
                    },
                    success:function(response){
                        $('#parent_id').empty();
                        $('#parent_id').append(response.view);
                    },
                    error:function(response){
                        alert('error')
                    }
                })
            })

        });
    </script>

@endsection
