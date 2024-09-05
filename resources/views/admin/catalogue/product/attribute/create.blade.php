@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('page-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">



@endsection

@section('content')
    <div class="content-wrapper" style="display:flex;flex-direction:column; justify-content:center">

        <form style="width:50%;" class="mt-5" action="{{ route('admin.catelogue.product.attribute.store') }}"
            method="POST">
            @csrf
            <h1 class="text-center">Create Product</h1>
            @include('admin.catalogue.product.attribute.form-fields')
            <button type="submit" class="btn btn-primary" style="margin-left: 90%">Submit</button>
        </form>

        <div class="card">
            <div class="card-body">
                <table id="attribute_dataTable" class="table display" style="width: 100%;">
                </table>
            </div>

        </div>
    </div>
@endsection

@section('page-js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"
        integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

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
            attendanceRequestDatatable();
        });


        function attendanceRequestDatatable() {
            let productId = "{{ $product->id }}";
 
            $("#attribute_dataTable").DataTable({
                ajax: {
                    url: "{{ route('admin.catelogue.product.attribute.index') }}",
                    data: { id: productId }
                },
                scrollX: true,
                scrollY: '500px',
                serverSide: true,
                fixedHeader: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: "DT_RowIndex",
                        title: "#",
                        className: 'text-nowrap',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'price',
                        name: 'price',
                        title: "Price",
                        className: 'text-nowrap',
                        orderable: false,
                        searchable: true,
                    },
                    {
                        data: 'size',
                        name: 'size',
                        title: "Size",
                        className: 'text-nowrap',
                        orderable: false,
                        searchable: true,
                    },

                    {
                        data: 'stock',
                        name: 'stock',
                        title: "Stock ",
                        className: 'text-nowrap',
                        orderable: false,
                        searchable: true,
                    },
                    {
                        data: 'sku',
                        name: 'sku',
                        title: "SKU ",
                        className: 'text-nowrap',
                        searchable: true,
                        orderable: false,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        title: "Status",
                        className: 'text-nowrap',
                        orderable: false,
                        searchable: true,
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                        title: "Created At",
                        className: 'text-nowrap',
                        searchable: false,
                        orderable: true,
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        title: "Updated At",
                        className: 'text-nowrap',
                        searchable: false,
                        orderable: true,
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        title: "Actions",
                        className: 'text-nowrap',
                        searchable: false,
                        orderable: false,
                    }

                ],
                dom: '<"card-header pt-0 custom_button_card "<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row custom_datatable_label"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>> C<"clear">',
                "buttons": [

                ],
                columnDefs: [{
                    targets: [0],
                    className: 'text-center',
                }],
                displayLength: 50,
                lengthMenu: [10, 20, 50, 100, 150, 200],
                language: {
                    processing: '<div class=" text-primary mt-5" role="status"><img src="{{ asset('app-assets') }}/images/comming-soon/Loader-current.gif"></div><br><div class="text-primary"></div>',
                    searchPlaceholder: "Search...",
                    paginate: {
                        previous: "&nbsp;",
                        next: "&nbsp;"
                    }
                },

                initComplete: function() {

                }
            });
        }
    </script>

@endsection
