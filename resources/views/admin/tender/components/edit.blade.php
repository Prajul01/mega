@push('style')
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/select2/dist/css/select2.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
.select2-search__field{
 width: 100% !important;
}
</style>
@endpush
<form method="POST" action="{{ route('admin.tender.update', base64_encode($tender->id)) }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Title"
                        value="{{ old('title',$tender->title) }}" aria-label="Title" aria-describedby="basic-addon1" required>
                </div>
                @error('title')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="feature" value="1"
                            @if ($tender->feature == '1') checked @endif></span>
                    </div>
                    <input type="text" class="form-control" value="Display Features" disabled>
                </div>
                @error('feature')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                @if ($tender->status == 'active') checked @endif></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                @error('status')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-8 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Sub Title</span>
                    </div>
                    <input type="text" class="form-control" name="sub_title" placeholder="Sub Title" aria-label="Title"
                        aria-describedby="basic-addon1" value="{{old('sub_title',$tender->sub_title)}}">
                </div>
                @error('sub_title')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Deadline</span>
                    </div>
                    <input type="date" class="form-control" id="date" name="deadline_date" placeholder="Date" aria-label="Date"
                        aria-describedby="basic-addon1" value="{{old('deadline_date',$tender->deadline)}}">
                </div>
                @error('deadline_date')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Tags</span>
                    </div>
                    @php
                    $data=array();
                    $tag=json_decode($tender->tags);
                    if(isset($tag)){
                        foreach($tag as $l){
                            array_push($data,$l);
                        }}
                    @endphp

                    <select class="multiple-cat form-control" name="tag[]" multiple="multiple">
                        @foreach($tags as $tag)
                           <option value="{{$tag->title}}"  @if (in_array($tag->title, $data)) selected @endif>
                           {{$tag->title}}
                           </option>
                        @endforeach
                   </select>
                </div>
                @error('tags')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Tender Category</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="tender_category">
                        <option selected disabled>Select Tender Category</option>
                        @foreach($tender_category as $category)
                        <option value="{{$category->id}}" {{$tender->tender_category_id==$category->id?'selected':''}}>{{$category->title}}</option>
                        @endforeach
                      </select>
                </div>
                @error('tender_category')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Tender Type</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="tender_type">
                        <option selected disabled>Select Tender Type</option>
                        @foreach($tender_type as $type)
                        <option value="{{$type->id}}" {{$tender->tender_type_id==$type->id?'selected':''}}>{{$type->title}}</option>
                        @endforeach
                      </select>
                </div>
                @error('tender_type')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Description</span>
                    </div>
                    <textarea name="description"  class="form-control"  id="ckeditor" rows="5">{{ old('description',$tender->description) }}</textarea>
                </div>
                @error('description')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Logo</span>
                    </div>
                    <input type="file" name="logo" class="dropify" data-default-file="{{ old('logo',asset('storage/tender/'.$tender->logo)) }}">
                </div>
                @error('logo')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.tender.index') }}" class="btn btn-danger">Cancel</a>
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
