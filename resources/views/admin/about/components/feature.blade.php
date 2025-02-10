@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
<form method="POST" action="{{ route('admin.about.update')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="feature" value="feature"/>
    <div class="body">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Heading</span>
                    </div>
                    <input type="text" class="form-control" name="feature_heading" placeholder="Heading"
                        value="{{ old('feature_heading',$about->feature_heading) }}" aria-label="Title" aria-describedby="basic-addon1" required>
                </div>
                @error('feature_heading')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
       
        <div class="col-md-12 py-2 bg-light">
            <h1>Content One</h1>
        </div>
        <div class="col-md-12 mb-3 mt-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Title</span>
                </div>
                <input type="text" name="feature_1_title" class="form-control" value="{{old('feature_1_title',$about->section_1_title)}}">
            </div>
            @error('feature_1_title')
            <span class="error">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Image</span>
                </div>
                <input type="file" name="feature_1_image" class="form-control dropify" data-default-file="{{ asset('storage/about/' . $about->section_1_image) }}">
            </div>
            @error('feature_1_image')
            <span class="error">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Short Description</span>
                </div>
                <textarea type="text" name="feature_1_description" rows="10" class="form-control">{{old('feature_1_description',$about->section_1_description)}}</textarea>
            </div>
            @error('feature_1_description')
            <span class="error">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-12 py-2 bg-light">
            <h1>Content Two</h1>
        </div>
        <div class="col-md-12 mb-3 mt-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Title</span>
                </div>
                <input type="text" name="feature_2_title" class="form-control" value="{{old('feature_2_title',$about->section_2_title)}}">
            </div>
            @error('feature_2_title')
            <span class="error">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Image</span>
                </div>
                <input type="file" name="feature_2_image" class="form-control dropify" data-default-file="{{ asset('storage/about/' . $about->section_2_image) }}">
            </div>
            @error('feature_2_image')
            <span class="error">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Short Description</span>
                </div>
                <textarea type="text" name="feature_2_description" rows="10" class="form-control" value="">{{old('feature_2_description',$about->section_2_description)}}</textarea>
            </div>
            @error('feature_2_description')
            <span class="error">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-12 py-2 bg-light">
            <h1>Content Three</h1>
        </div>
        <div class="col-md-12 mb-3 mt-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Title</span>
                </div>
                <input type="text" name="feature_3_title" class="form-control" value="{{old('feature_3_title',$about->section_3_title)}}">
            </div>
            @error('feature_3_title')
            <span class="error">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Image</span>
                </div>
                <input type="file" name="feature_3_image" class="form-control dropify" data-default-file="{{ asset('storage/about/' . $about->section_3_image) }}">
            </div>
            @error('feature_3_image')
            <span class="error">{{$message}}</span>
            @enderror
        </div>
       
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Short Description</span>
                </div>
                <textarea type="text" name="feature_3_description" class="form-control" rows="10">{{old('feature_3_description',$about->section_3_description)}}</textarea>
            </div>
            @error('feature_3_description')
            <span class="error">{{$message}}</span>
            @enderror
        </div>
    </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.about.index') }}" class="btn btn-danger">Cancel</a>
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
