@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<form method="POST" action="{{ route('admin.notice.update', base64_encode($notice->id)) }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Title"
                        value="{{ old('title',$notice->title) }}" aria-label="Title" aria-describedby="basic-addon1" required>
                </div>
                @error('title')
                <span class="error">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                @if ($notice->status == 'active') checked @endif></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                @error('status')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
           
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">File</span>
                    </div>
                    <input type="file" name="file" data-default-file="{{ asset('storage/notice/' . $notice->file) }}"
                        class="dropify" accept="application/pdf">

                </div>
                @error('file')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-12">
                <div class="alert alert-warning">
                   Upload PDF File
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.notice.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>
@push('script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/select2/dist/js/select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.multiple-cat').select2();
        });
    </script>
@endpush
