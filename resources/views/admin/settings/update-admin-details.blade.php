@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

@endsection
@section('content')
    <div class="content-wrapper">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Update Admin Details</h4>

                        <form action="{{ route('admin.update-admin-details') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Email/Username Field -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Email/Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $admin->email }}" readonly>
                            </div>

                            <!-- Type Field -->
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <input class="form-control" name="type" value="{{ $admin->type }}" readonly>
                            </div>

                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Mobile No Field -->
                            <div class="mb-3">
                                <label for="mobile_no" class="form-label">Mobile No</label>
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ $admin->mobile_no }}">
                                @error('mobile_no')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- FilePond Upload Field -->
                            <div class="mb-4">
                                <label for="file" class="form-label">Upload Images</label>
                                <input type="file" class="filepond" name="file[]" id="file" data-max-file-size="10MB" data-max-files="3" >
                                @error('file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit and Cancel Buttons -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button type="button" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('pags-js')
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- filepond --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
        <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet">
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}

        {{-- end file --}}
        <script>
            $(document).ready(function() {
                FilePond.registerPlugin(
                    FilePondPluginImagePreview
                );
                var files = [];
                @if (!empty($admin->image))
                files.push({
                        source: '{{ asset("storage/" . $admin->image) }}',
                    });

                @endif

                FilePond.create(document.getElementById('file'), {
                    files:files,
                    styleButtonRemoveItemPosition: 'right',
                    imageCropAspectRatio: '1:1',
                    acceptedFileTypes: ['image/png', 'image/jpeg', 'image/gif'],
                    maxFileSize: '100000KB',
                    ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
                    storeAsFile: false,
                    allowMultiple: false,
                    checkValidity: true,
                    server: {
                        timeout: 7000,
                        process: {
                            url: '/upload-temp',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            },
                            onload: (response) => {
                                const fileDataArray = JSON.parse(response);
                                return fileDataArray[0].filename;
                            },
                            onerror: (response) => {
                                console.error('Error uploading file:', response);
                            }
                        },
                        revert: {
                            url: '/revert-temp',
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            onload: (response) => {
                                console.log('File reverted successfully:', response);
                            },
                            onerror: (error) => {
                                console.error('Error reverting file:', error);
                            }
                        }
                    },
                    credits: {
                        label: '',
                        url: ''
                    }
                });

            });
        </script>
