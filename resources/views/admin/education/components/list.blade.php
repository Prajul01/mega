@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}" />
@endpush
<div class="card">
    <div class="dd" id="nestable">
        <ol class="dd-list has-header">
            @foreach ($educations as $education)
                <li class="dd-item dd3-item list-item" data-id="{{ $education->id }}">
                    <div class="dd-handle dd3-handle"></div>
                    <div class="custom-handle-flex">
                        <div class="icon-image-name">
                            <div style="display: flex; align-items:center;">
                                <img src="{{ asset('/storage/education/' . $education->image) }}" alt="{{ $education->title }}" class="img-thumbnail mr-2" style="width:40px;">
                                <h6 class=" mb-0">
                                    {{ $education->title }} | <small
                                        class="{{ $education->status == 'active' ? 'badge badge-primary' : 'badge badge-danger' }}">{{ $education->status == 'active' ? 'Displayed' : 'Not Display' }}</small>
                                </h6>
                            </div>
                        </div>
                        <div style="display: flex">
                            @can('education-edit')
                                <a href="{{ route('admin.education.edit', base64_encode($education->id)) }}"
                                    class="btn btn-sm btn-outline-info" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('education-delete')
                                &nbsp;
                                <button type="button" onclick="COnfirmDelete('{{ $education->id }}')"
                                    data-id="{{ $education->id }}" class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i></button>
                            @endcan
                        </div>
                    </div>
                </li>
            @endforeach
        </ol>

    </div>
</div>
@push('script')
    <script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script>
    <script>
        $(document).ready(function() {
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.education.order') }}",
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
    <script src="{{ asset('backend/vendor/sweetalert/sweetalert.min.js') }}"></script>
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
            }, function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: "POST",
                        url: '{{ route('admin.education.destroy') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': id
                        },
                        success: function(res) {
                            swal({
                                title: "Deleted",
                                text: "Education has been deleted!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#28a745",
                                confirmButtonText: "Okay",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(data) {
                            // toastr.error("Sorry Something Went Wrong!!");
                        }

                    })
                } else {
                    swal("Cancelled", "Your education is safe :)", "error");
                }
            });
        }
    </script>
@endpush
