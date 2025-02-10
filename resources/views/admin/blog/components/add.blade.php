@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/select2/dist/css/select2.css') }}">
    <style>
        .select2, .select2-search__field {
            width: 100% !important;
        }
    </style>
@endpush
<form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title </span>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Title" aria-label="Title"
                        aria-describedby="basic-addon1" value="{{ old('title') }}" required>
                </div>
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                checked></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                @error('status')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Author</span>
                    </div>
                    <input type="text" class="form-control" name="author" placeholder="Author" aria-label="Auhor"
                        aria-describedby="basic-addon1" value="{{ old('author') }}">
                </div>
                @error('author')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Name</span>
                    </div>
                    <input type="text" class="form-control" name="company_name" placeholder="Company Name"
                        aria-label="Company Name" aria-describedby="basic-addon1" value="{{ old('company_name') }}">
                </div>
                @error('company_name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Tags</span>
                    </div>
                    <select class="multiple-cat form-control" name="tag[]" multiple="multiple" required>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->title }}" {{ old('tag')? in_array($tag->title, old('tag')) ? 'selected' : '' : '' }}>
                                {{ $tag->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('tags')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Image</span>
                    </div>
                    <input type="file" name="image" class="dropify" data-default-file="{{ old('image') }}" required>
                </div>
                @error('image')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12">
                <div class="alert alert-warning">
                    Best Image Size 1200 X 600 PX.
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Description</span>
                    </div>
                    <textarea name="description" class="form-control" id="ckeditor" rows="5" required>{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>


        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.blog.index') }}" class="btn btn-danger">Cancel</a>
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
@endpush
