@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('page-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@endsection

@section('content')
    <div class="content-wrapper" style="display:flex;justify-content:center">

        <form style="width:50%;" class="mt-5" action="{{ route('admin.catelogue.product.attribute.store') }}" method="POST">
            @csrf
            <h1 class="text-center">Create Product</h1>
            @include('admin.catalogue.product.attribute.form-fields')
            <button type="submit" class="btn btn-primary" style="margin-left: 90%">Submit</button>
        </form>
    </div>
@endsection

@section('page-js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </script>

    <script>
        $(document).ready(function() {
            $('.attribute_repeaater').repeater({
            // initEmpty:true,
            isFirstItemUndeletable: true,
            show: function() {
                $(this).slideDown();
                // var uniqueIndex = $('.color_repeater').find('[data-repeater-item]').length - 1;
                // $(this).find('select.size').each(function() {
                //     var newId = 'size-' + uniqueIndex;
                //     $(this).attr('id', newId);
                //     new MultiSelectTag(newId);
                // });
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });
            // FilePond.registerPlugin(
            //     FilePondPluginImagePreview
            // );

            // var files = [];
            // @if (isset($product_video))
            //     @forelse($product_video as $video)

            //         files.push({
            //             source: '{{ $video->getUrl() }}',
            //         });
            //     @empty
            //     @endforelse
            // @endif
            // FilePond.create(document.getElementById('upload_image'), {
            //     files: files,
            //     styleButtonRemoveItemPosition: 'right',
            //     allowImagePreview: true,
            //     // imageValidateSizeMinWidth: 1000,
            //     // imageValidateSizeMinHeight: 1000,
            //     imageCropAspectRatio: '1:1',
            //     acceptedFileTypes: ['image/png', 'image/jpeg', 'image/gif', 'application/pdf'],
            //     maxFileSize: '100000KB',
            //     ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
            //     storeAsFile: false,
            //     allowMultiple: true,
            //     maxFiles: 3,
            //     // required: true,
            //     checkValidity: true,
            //     chunkUploads: true,
            //     chunkSize: '200KB',
            //     chunkForce: true,
            //     server: {
            //         timeout: 7000,
            //         process: '/files/getUploadId',
            //         revert: '/files/revertFile',
            //         patch: '/files/uploadfileChunk?patch=',
            //         headers: {
            //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //         }
            //     },
            //     credits: {
            //         label: '',
            //         url: ''
            //     }
            // });


            // FilePond.create(document.getElementById('upload_video'), {
            //     files: files,
            //     styleButtonRemoveItemPosition: 'right',
            //     // allowImagePreview: true,
            //     // imageValidateSizeMinWidth: 1000,
            //     // imageValidateSizeMinHeight: 1000,
            //     // imageCropAspectRatio: '1:1',
            //     acceptedFileTypes: ['video/mp4', 'video/quicktime'],
            //     maxFileSize: '100000KB',
            //     ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
            //     storeAsFile: false,
            //     // allowMultiple: true,
            //     maxFiles: 3,
            //     // required: true,
            //     checkValidity: true,
            //     chunkUploads: true,
            //     chunkSize: '200KB',
            //     chunkForce: true,
            //     server: {
            //         timeout: 7000,
            //         process: '/files/getUploadId',
            //         revert: '/files/revertFile',
            //         patch: '/files/uploadfileChunk?patch=',
            //         headers: {
            //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //         }
            //     },
            //     credits: {
            //         label: '',
            //         url: ''
            //     }
            // });



            // $('#section_id').on('change', function() {
            //     let section_id = $('#section_id').val();
            //     // alert(section_id)

            //     if (section_id > 0)

            //         $.ajax({
            //             type: 'post',
            //             url: '{{ route('admin.catelogue.product.append-categories') }}',
            //             data: {
            //                 'section_id': section_id
            //             },
            //             headers: {
            //                 'X-CSRF-Token': '{{ csrf_token() }}'
            //             },
            //             success: function(response) {
            //                 $('#parent_id').empty();
            //                 $('#parent_id').append(response.view);
            //             },
            //             error: function(response) {
            //                 alert('error')
            //             }
            //         })
            // })

        });
    </script>

@endsection
