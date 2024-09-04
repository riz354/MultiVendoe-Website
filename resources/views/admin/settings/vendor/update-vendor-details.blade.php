@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

@endsection

@section('content')
    <div class="content-wrapper">


        @if ($slug == 'personal')
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="card-title text-center mb-4">Update Admin Details</h4>

                            <form action="{{ route('admin.update-vendor-details', ['slug' => 'personal']) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Email/Username Field -->
                                <div class="mb-3">
                                    <label for="username" class="form-label">Email/Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ $vendor->email }}" readonly>
                                </div>



                                <!-- Name Field -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $vendor->name }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Mobile No Field -->
                                <div class="mb-3">
                                    <label for="mobile_no" class="form-label">Mobile No</label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                        value="{{ $vendor->mobile_no }}">
                                    @error('mobile_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ $vendor->address }}">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class=" mb-2">
                                    <label class="form-label  fs-6" style="font-size: 15px" for="country">Country<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select select2 form-select-md fs-6" id="residential_country"
                                        name="residential_country" placeholder="Select Country">
                                        <option value="" selected>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Select Country</small>
                                    @error('residential_country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" position-relative mb-2">
                                    <label class="form-label  fs-6" style="font-size: 15px" for="residential_state">Select
                                        State<span class="text-danger">*</span></label>
                                    <select class="form-select select2 form-select-md fs-6" id="residential_state"
                                        name="residential_state" placeholder="">
                                        <option value="" selected>Select State</option>
                                    </select>
                                    <small class="text-muted">Select state</small>
                                    @error('residential_state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" position-relative mb-2">
                                    <label class="form-label  fs-6" style="font-size: 15px" for="residential_city">Select
                                        city<span class="text-danger">*</span></label>
                                    <select class="form-select select2 form-select-md fs-6" id="residential_city"
                                        name="residential_city" placeholder="">
                                        <option value="" selected>Select City</option>
                                    </select>
                                    <small class="text-muted">Select city</small>
                                    @error('residential_city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="pin_code" class="form-label">Pin Code</label>
                                    <input type="text" class="form-control" id="pin_code" name="pin_code"
                                        value="{{ $vendor->pin_code }}">
                                    @error('pin_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>



                                <!-- FilePond Upload Field -->


                                <div class="mb-4">
                                    <label for="file" class="form-label">Upload Images</label>
                                    <input type="file" class="filepond" name="file[]" id="file"
                                        data-max-file-size="10MB" data-max-files="3">
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
        @endif
    </div>
@endsection



@section('page-js')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>


    <script>
        $(document).ready(function() {
            FilePond.registerPlugin(
                FilePondPluginImagePreview
            );
            var files = [];
            @if (!empty($admin->image))
                files.push({
                    source: '{{ asset('storage/' . $admin->image) }}',
                });
            @endif



            FilePond.create(document.getElementById('file'), {
                files: files,
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


        var residential_country = $("#residential_country");
        residential_country.wrap('<div class="position-relative"></div>');
        residential_country.on('change', function() {

            $("#residential_city").empty()
            $('#residential_state').empty();
            $('#residential_state').html('<option value="">Select State</option>');
            $('#residential_city').html('<option value="">Select City</option>');

            var _token = '{{ csrf_token() }}';
            let url =
                "{{ route('ajax-get-states', ['countryId' => ':countryId']) }}"
                .replace(':countryId', $(this).val());
            if ($(this).val() > 0) {

                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'stateId': $(this).val(),
                        '_token': _token
                    },
                    success: function(response) {
                        if (response.success) {

                            $.each(response.states, function(key, value) {
                                $("#residential_state").append('<option value="' +
                                    value
                                    .id + '">' + value.name + '</option>');
                            });



                            residential_state.trigger('change');

                            // @if (!is_null(old('residential.state')))
                            //     $('#residential_state').val({{ old('residential.state') }})
                            //         .trigger('change');
                            //     $('#residential_state').trigger('change')
                            // @endif
                        } else {

                            // Swal.fire({
                            //     icon: 'error',
                            //     title: 'Error',
                            //     text: response.message,
                            // });
                            toastr.error('something wrong');
                        }
                    },
                    error: function(error) {
                        console.log(error);

                    }
                });
            }
        });


        var residential_state = $("#residential_state");
        residential_state.wrap('<div class="position-relative"></div>');
        residential_state.on('change', function() {
            $("#residential_city").empty()
            $('#residential_city').html('<option value="">Select City</option>');

            var _token = '{{ csrf_token() }}';
            let url =
                "{{ route('ajax-get-cities', ['stateId' => ':stateId']) }}"
                .replace(':stateId', $(this).val());
            if ($(this).val() > 0) {

                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'stateId': $(this).val(),
                        '_token': _token
                    },
                    success: function(response) {
                        if (response.success) {
                            $.each(response.cities, function(key, value) {
                                $("#residential_city").append('<option value="' +
                                    value
                                    .id + '">' + value.name + '</option>');
                            });

                            residential_city.trigger('change');

                            // @if (!is_null(old('residential.city')))
                            //     $('#residential_city').val({{ old('residential.city') }});
                            //     $('#residential_city').trigger('change')
                            // @endif
                        } else {

                            toastr.error('something wrong');

                        }
                    },
                    error: function(error) {
                        console.log(error);

                    }
                });
            } else {

            }


        });
    </script>


@endsection
