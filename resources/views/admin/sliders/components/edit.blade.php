@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<form method="POST" action="{{ route('admin.sliders.update', base64_encode($slider->id)) }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="title"
                           placeholder="Title" value="{{ $slider->title }}"
                           aria-label="Title"
                           aria-describedby="basic-addon1" required>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="display" value="1"
                                                              @if($slider->display ==1) checked @endif></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
            </div>
           <div class="col-md-6">
                <div class="alert alert-warning">
                    Best Image Size 1420 X 450  PX.
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Image</span>
                    </div>
                    <input type="file" name="image" data-default-file="{{ asset('storage/slider/'.$slider->image) }}"
                           class="dropify">
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Slider Url (Optional)</span>
                    </div>
                    <input type="text" class="form-control" name="redirect_url"
                           placeholder="Slider Url" value="{{ $slider->redirect_url }}"
                           aria-label="Link"
                           aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" name="submit" class="btn btn-success" value="save">Save</button>
    </div>
</form>
@push('script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
@endpush
