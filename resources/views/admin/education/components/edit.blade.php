<form method="POST" action="{{ route('admin.education.update', base64_encode($education->id)) }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Title"
                        value="{{ old('title',$education->title) }}" aria-label="Title" aria-describedby="basic-addon1" required>
                </div>
                @error('title')
                <span class="error">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                @if ($education->status == 'active') checked @endif></span>
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
                        <span class="input-group-text">Image</span>
                    </div>
                    <input type="file" name="image" class="dropify" value="{{old('iage')}}" data-default-file="{{ asset('storage/education/' . $education->image) }}">
                </div>
                @error('image')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.education.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>


@push('script')
<script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>

@endpush