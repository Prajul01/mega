@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<form method="POST" action="{{ route('admin.faq.update', base64_encode($faq->id)) }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Title"
                        value="{{ old('title',$faq->title) }}" aria-label="Title" aria-describedby="basic-addon1" required>
                </div>
                @error('title')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Type</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="faq_type">
                        <option selected disabled value="">Select Type</option>
                        <option value="job_seeker" {{$faq->faq_type=="job_seeker"?'selected':''}}>Job Seeker</option>
                        <option value="employer" {{$faq->faq_type=="employer"?'selected':''}}>Employeer</option>
                      </select>
                </div>
                @error('faq_type')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                @if ($faq->status == 'active') checked @endif></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                @error('status')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
           
            <div class="col-12">
                <div class="card-header">
                    <h5>FAQ Descriptions</h5>
                </div>
            </div>
           
           @php
              $description=json_decode($faq->description);
              $sub_title=json_decode($faq->sub_title);
           @endphp
            <div class="col-md-12 mb-3">
                <div class="row varient-add">
                    @foreach ( $sub_title as $key=>$item)
                    <div class="col-md-5 border m-3">
                        <div class="row">
                            <div class="col-md-11 mt-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Question</span>
                                    </div>
                                    <textarea class="form-control" name="sub_title[]" rows="4">{{$item}}</textarea>
                                </div>
                            </div>
                            @if($key>0)
                            <div class="col-md-1"><a href="{{ route('admin.faq.delete_data',['id'=>base64_encode($faq->id),'key'=>$key]) }}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a></div>
                            @endif
                            <div class="col-md-11 mt-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Answer</span>
                                    </div>
                                    <textarea class="form-control" name="description[]" rows="6">{{$description[$key]}}</textarea>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="col-12">
                <div class="add-more-btn">
                    <button type="button" class="btn btn-success btn__bordered btn__hover2 add-varient">Add More +</button>
                </div>
            </div>

        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.faq.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>
@push('script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script src="{{ asset('backend/assets/vendor/select2/dist/js/select2.js') }}"></script>
    <script>
        var editor_config = {
            toolbar: [{
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']
                   
                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', '-', 'JustifyLeft',
                        'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                    ]
                },
                {
                    name: 'links',
                    items: ['Link']
                },
                '/',
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor']
                },
            ],
            width: ['100%']
        };
        CKEDITOR.replace('ckeditor', editor_config);
    </script>
    <script>
        $(document).ready(function() {
            $('.multiple-cat').select2();
        });
    </script>
     <script>
        $(".add-varient").click(function() {
            $(".varient-add").append(
                `<div  class="varient col-md-5 border m-3"><div class="row">
                            <div class=" m-3">
                                <div class="row">
                                    <div class="col-md-11 mt-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Sub Title</span>
                                            </div>
                                            <textarea class="form-control" name="sub_title[]" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-1"><button class="btn btn-danger remove" type="button"><i class="fa fa-trash"></i></button></div>
                                    <div class="col-md-11 mt-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Description</span>
                                            </div>
                                            <textarea class="form-control" name="description[]" rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div>`
        )});

        $(document).on('click', '.remove', function() {
            $(this).closest(".varient").remove();
        });
        </script>
@endpush
