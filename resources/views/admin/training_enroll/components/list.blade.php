@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}"/>
@endsection
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
    <style>
        .wrapper .page-wrap .main-content .page-header .page-header-title i {
            width: 50px !important;
            height: 50px !important;
        }
    </style>
@endpush
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="tab-content mt-0">
            <div class="tab-pane show active" id="Pages">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="body">
                                    <div class="table-responsive p-3">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($trainingEnroll as $te)
                                                <tr>
                                                    <td>{{ $te->name }}</td>
                                                    <td>{{ $te->mobile }}</td>
                                                    <td>{{ $te->email }}</td>

{{--                                                    <td class="col">--}}
{{--                                                        <div class="list-actions">--}}
{{--                                                            @can('role-list')--}}
{{--                                                                <a href="{{ route('admin.roles.show', $te->id) }}"--}}
{{--                                                                   class="btn btn-icon btn-primary"><i class="fa fa-eye"></i></a>--}}
{{--                                                            @endcan--}}
{{--                                                            @can('role-edit')--}}
{{--                                                                <a href="{{ route('admin.roles.edit', $te->id) }}"--}}
{{--                                                                   class="btn btn-icon btn-info"><i class="fa fa-edit"></i></a>--}}
{{--                                                            @endcan--}}
{{--                                                            @can('role-delete')--}}
{{--                                                                <a href="#delete" data-toggle="modal"--}}
{{--                                                                   class="btn btn-icon btn-danger"--}}
{{--                                                                   onclick="delete_role('{{ base64_encode($te->id) }}')"><i--}}
{{--                                                                        class="fa fa-trash"></i></a>--}}
{{--                                                            @endcan--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@section('script')
    <script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script>
    <script src="{{asset('backend/html/assets/js/pages/ui/sortable-nestable.js')}}"></script>
    <script>
        $("#nestable").nestable();
    </script>
    <script src="{{ asset('backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        function COnfirmDelete(elem) {
            var id = elem;
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this again !",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: "POST",
                        url: '{{ route("admin.training.destroy") }}',
                        data: {
                            '_token' : '{{ csrf_token() }}',
                            'id' : id
                        },
                        success:function(res)
                        {
                             swal({
                                    title: "Deleted",
                                    text: "Training has been deleted!",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#28a745",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                    closeOnCancel: false
                                }, function (isConfirm) {
                                    if(isConfirm)
                                    {
                                        location.reload();
                                    }
                                }
                            );
                        },
                        error:function(data)
                        {
                            // toastr.error("Sorry Something Went Wrong!!");
                        }

                    })
                } else {
                    swal("Cancelled", "Your training is safe :)", "error");
                }
            });
        }
    </script>
{{--     <script>--}}
{{--        $(document).ready(function() {--}}
{{--            var updateOutput = function(e) {--}}
{{--                var list = e.length ? e : $(e.target),--}}
{{--                    output = list.data('output');--}}
{{--                $.ajax({--}}
{{--                    method: "POST",--}}
{{--                    url: "{{ route('admin.training.order') }}",--}}
{{--                    data: {--}}
{{--                        '_token': $('input[name=_token]').val(),--}}
{{--                        list_order: list.nestable('serialize'),--}}
{{--                        table: "categories"--}}
{{--                    },--}}
{{--                    success: function(response) {--}}
{{--                        // console.log("success");--}}
{{--                        // console.log("response " + response);--}}
{{--                        var obj = jQuery.parseJSON(response);--}}
{{--                        if (obj.status == 'success') {--}}
{{--                            toastr.success("Content Sorted Successfully");--}}
{{--                        }--}}
{{--                        if (obj.status == 'error') {--}}
{{--                            toastr.error("Sorry Something Went Wrong!!");--}}
{{--                        };--}}

{{--                    }--}}
{{--                }).fail(function(jqXHR, textStatus, errorThrown) {--}}
{{--                    toastr.error("Something Went Wrong!");--}}
{{--                });--}}
{{--            };--}}

{{--            $('#nestable').nestable({--}}
{{--                group: 1,--}}
{{--                maxDepth: 1,--}}
{{--            }).on('change', updateOutput);--}}
{{--        });--}}
{{--    </script>--}}
@endsection
