@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<form method="POST" action="{{ route('admin.staffs.update', base64_encode($staff->id)) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</span>
                    </div>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" aria-label="Name"
                        aria-describedby="basic-addon1" value="{{ old('name', @$staff->name) }}" required>
                </div>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="display" {{ old('display', @$staff->display)? 'checked': '' }}></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Email</span>
                    </div>
                    <input type="text" class="form-control" name="email" placeholder="Enter email"
                        aria-label="email" aria-describedby="basic-addon1" value="{{ old('email', @$staff->email) }}" required>
                </div>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Phone No.</span>
                    </div>
                    <input type="text" class="form-control" name="phone_no" placeholder="Enter phone_no"
                        aria-label="phone_no" aria-describedby="basic-addon1" value="{{ old('phone_no', @$staff->phone_no) }}" required>
                </div>
                @error('phone_no')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 my-3">
                
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-image"></i>&nbsp;Profile</span>
                        <span class="alert alert-warning">
                            Recommended Size: 400 X 375 px
                        </span>
                    </div>
                    <input type="file" class="dropify" name="profile_pic" placeholder="Upload Profile Picture" aria-label="Name"
                        aria-describedby="basic-addon1" required data-default-file="{{ asset('/storage/supportStaff/' . @$staff->profile_pic) }}">
                </div>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.staffs.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" name="submit" class="btn btn-success" value="save">Save</button>
    </div>
</form>
@push('script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/js/pages/forms/dropify.js') }}"></script>
@endpush
