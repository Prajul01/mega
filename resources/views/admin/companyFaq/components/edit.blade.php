@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<form method="POST" action="{{ route('admin.companyFAQ.update', base64_encode($faq->id)) }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Question</span>
                    </div>
                    <input type="text" class="form-control" name="question" placeholder="question"
                        aria-label="question" aria-describedby="basic-addon1" value="{{ old('question', @$faq->question) }}" required>
                </div>
                @error('question')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="display" value="active"
                                {{ old('display', @$faq->display)? 'checked': '' }}></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                @error('display')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Answer</span>
                    </div>
                </div>
                <textarea class="form-control" name="answer" style="height: 250px;">{{ old('answer', @$faq->answer) }}</textarea>

                @error('title')
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
@endpush
