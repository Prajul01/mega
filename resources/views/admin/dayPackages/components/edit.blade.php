@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<form method="POST" action="{{ route('admin.dayPackages.update', base64_encode($package->id)) }}"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="body">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Package Name</span>
                    </div>
                    <input type="text" class="form-control" name="package_name" placeholder="Package Name"
                        value="{{ old('package_name', @$package->days) }}" aria-label="Package Name" aria-describedby="basic-addon1" required>
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
