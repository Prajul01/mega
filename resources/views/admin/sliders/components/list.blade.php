@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}" />
@endpush
<div class="card">
    <div class="dd" id="nestable">
        <ol class="dd-list has-header">
            @foreach ($sliders as $slider)
                <li class="dd-item dd3-item list-item" data-id="{{ $slider->id }}">
                    <div class="dd-handle dd3-handle"></div>
                    <div class="custom-handle-flex">
                        <div class="icon-image-name">
                            <div>
                                <h6 class=" mb-0">
                                    {{ $slider->title }} | <small
                                        class="{{ $slider->display == 1 ? 'badge badge-primary' : 'badge badge-danger' }}">{{ $slider->display == 1 ? 'Displayed' : 'Not Display' }}
                                    </small>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <label class="switch">
                                        <input type="checkbox" name="toogle" value="{{ $slider->id }}"
                                            data-toggle="switchbutton" {{ $slider->display == '1' ? 'checked' : '' }}
                                            data-onlabel="1" data-offlabel="0" data-size="sm" data-onstyle="success"
                                            data-offstyle="danger" @cannot('site-edit') disabled @endcannot>
                                        <span class="slider round"></span>
                                    </label>
                                </h6>

                            </div>
                        </div>
                        <div style="display: flex">
                            @can('site-edit')
                                <a href="{{ route('admin.sliders.edit', base64_encode($slider->id)) }}"
                                    class="btn btn-sm btn-outline-info" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('site-delete')
                                &nbsp;
                                <button type="button" onclick="COnfirmDelete('{{ $slider->id }}')"
                                    data-id="{{ $slider->id }}" class="btn btn-sm btn-outline-danger"><i
                                        class="fa fa-trash"></i></button>
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
                    url: "{{ route('admin.sliders.order') }}",
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
        $('input[name=toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(mode);
            $.ajax({
                url: "{{ route('admin.sliders.status') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    // console.log(response.status);
                    if (response.status) {
                        swal({
                            title: "Good job!",
                            text: response.msg,
                            icon: "success",
                            button: "OK!",
                        });
                    } else {
                        alert('Please try again!');
                    }
                }

            })

        });

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
                        url: '{{ route('admin.sliders.destroy') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': id
                        },
                        success: function(res) {
                            swal({
                                title: "Deleted",
                                text: "Slider has been deleted!",
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
                    swal("Cancelled", "Your slider is safe :)", "error");
                }
            });
        }
    </script>
@endpush
