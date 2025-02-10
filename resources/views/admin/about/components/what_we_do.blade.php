@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Heading</span>
                    </div>
                    <input type="text" class="form-control" name="what_we_do_heading" placeholder="heading"
                        value="{{ old('what_we_do_heading',$about->what_we_do_heading) }}" aria-label="heading" aria-describedby="basic-addon1">
                </div>
                @error('what_we_do_heading')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-8 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="what_we_do_title" placeholder="title"
                        value="{{ old('what_we_do_title',$about->what_we_do_title) }}" aria-label="title" aria-describedby="basic-addon1">
                </div>
                @error('what_we_do_title')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Image</span>
                    </div>
                    <input type="file" class="dropify" name="what_we_do_image"  data-default-file="{{ asset('storage/about/' . $about->what_we_do_image) }}">
                </div>
                @error('what_we_do_image')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Description</span>
                    </div>
                    <textarea name="what_we_do_description" id="ckeditor" class="form-control">{!! old('what_we_do_description',$about->what_we_do_description) !!}</textarea>
                </div>
                @error('what_we_do_description')
                <span class="error">{{$message}}</span>
                @enderror
            </div>


        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.about.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
    <input type="hidden" name="what_we_do" value="what_we_do"/>
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
@endpush
