@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<form method="POST" action="{{ route('admin.district.update', base64_encode($district->id)) }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">District Name</span>
                    </div>
                    <input type="text" class="form-control" name="district_name" placeholder="Title"
                        value="{{ old('district_name',$district->name) }}" aria-label="Title" aria-describedby="basic-addon1" required>
                </div>
                @error('district_name')
                <span class="error">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                @if ($district->status == 'active') checked @endif></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                @error('status')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Province Name</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="province_name">
                        <option selected disabled value="">Select Province</option>
                        @foreach($provinces as $province)
                        <option value="{{$province->id}}" {{$province->id==$district->id?"selected":''}}>{{$province->name}}</option>
                        @endforeach
                      </select>
                </div>
                @error('province_name')
                <span class="error">{{$message}}</span>
                @enderror
            </div>


        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.district.index') }}" class="btn btn-danger">Cancel</a>
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
