@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}"/>
@endsection
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="tab-content mt-0">
            <div class="tab-pane show active" id="Pages">
                <div class="card">
                    @if(count($advertisement)>0)
                    <div class="body mt-0">
                        <div class="dd nestable-with-handle" id="nestable">
                            <ol class="dd-list">
                                @foreach($advertisement as $ad)
                                <li class="dd-item dd3-item image-none" data-id="{{ $ad->id }}">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                        <small>
                                            &nbsp;&nbsp;&nbsp;
                                            <b> {{ $ad->title }}</b> | <i style="font-size: 10px;" class="{{ $ad->display == 1 ? 'badge badge-primary' : 'badge badge-danger' }}">  {{ $ad->display == 1 ? 'Displayed' : 'Not Display' }}</i> | <i style="font-size: 10px;" class="badge badge-primary">@if($ad->type=='1') Main Banner @elseif($ad->type=='2') SideBar Video @else SideBar Image @endif</i> </i>
                                        </small>
                                        <span class="content-right">

                                            <a href="{{ route('admin.advertisement.edit',base64_encode($ad->id)) }}"
                                                class="btn btn-sm btn-outline-primary" title="Edit"><i
                                                    class="fa fa-edit"></i></a>

                                            <a href="#delete" data-toggle="modal" data-id="1"
                                                id="delete1"
                                                class="btn btn-sm btn-outline-danger delete"
                                                onclick="COnfirmDelete('{{ $ad->id }}')" data-id="{{ $ad->id }}"> <i
                                                    class="fa fa-trash"></i>
                                            </a>
                                        </span>
                                    </div>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                    @else
                    <div class="body my-2">
                        <div class="text-center">
                            <h3>Data not Found!!</h3>
                        </div>
                    </div>
                    @endif
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
                text: "You will not be able to recover this imaginary file!",
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
                        url: '{{ route("admin.advertisement.destroy") }}',
                        data: {
                            '_token' : '{{ csrf_token() }}',
                            'id' : id
                        },
                        success:function(res)
                        {
                             swal({
                                    title: "Deleted",
                                    text: "advertisement has been deleted!",
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
                    swal("Cancelled", "Your advertisement is safe :)", "error");
                }
            });
        }
    </script>
     <script>
        $(document).ready(function() {
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.advertisement.order') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        list_order: list.nestable('serialize'),
                        table: "categories"
                    },
                    success: function(response) {
                        // console.log("success");
                        // console.log("response " + response);
                        var obj = jQuery.parseJSON(response);
                        if (obj.status == 'success') {
                            toastr.success("Content Sorted Successfully");
                        }
                        if (obj.status == 'error') {
                            toastr.error("Sorry Something Went Wrong!!");
                        };

                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    toastr.error("Something Went Wrong!");
                });
            };

            $('#nestable').nestable({
                group: 1,
                maxDepth: 1,
            }).on('change', updateOutput);
        });
    </script>
@endsection
