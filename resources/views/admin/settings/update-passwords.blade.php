@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection
@section('content')
    <div class="content-wrapper">


        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card mt-5">
                    <div class="card-body">

                        <form class="forms-sample" action="{{ route('admin.update-password-post') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email/Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Username" value="{{ $admin->email }}" readonly>
                            </div>
                            <div class="">
                                <label>Type</label>
                                <input class="form-control" name="type" value="{{ $admin->type }}" readonly>
                            </div>


                            <div class="form-group">
                                <label for="c_password">Current Password</label>
                                <input type="password" class="form-control" id="c_password" name="c_password"
                                    placeholder="Current Password" value="{{old('c_password')}}">
                                    <small id="c_password_error" class="text-danger"></small>

                                @error('c_password')
                                    <small id="" class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="n_password">New Password</label>
                                <input type="password" class="form-control" id="n_password" name="n_password"
                                    placeholder="Password" value="{{old('n_password')}}">
                                    @error('n_password')
                                    <small  class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="c_n_password">Confirm New Password</label>
                                <input type="password" class="form-control" id="c_n_password" name="c_n_password"
                                    placeholder="Password" value="{{old('c_n_password')}}">
                                    @error('c_n_password')
                                    <small  class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                    Remember me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
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

        <script>
            $(document).ready(function() {

                $('#c_password').on('change', function() {
                    var pwd = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('admin.check-admin-passsword') }}",
                        data: {
                            'pwd': pwd
                        },
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Please enter new password')
                                $('#c_password_error').text('')


                            } else if (response.validation) {
                                $('#c_password_error').text(response.validation.pwd)
                                

                            } else if (response.success == false) {
                                $('#c_password_error').text(''),
                                    $('#c_password_error').text('Password is invalid')


                            }

                        },
                        error: function() {
                            toastr.success('Something went wrong')

                        }
                    })
                });
            });
        </script>
