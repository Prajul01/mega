@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
<form method="POST" action="{{ route('admin.showrooms.update', base64_encode($showroom->id)) }}"
    enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Location <span class="text-danger">*</span> </span>
                    </div>
                    <input type="text" class="form-control" name="location"
                        value="{{ old('location', $showroom->location) }}" placeholder="Location eg. Kathmandu"
                        aria-label="Location" aria-describedby="basic-addon1" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Showroom name <span class="text-danger">*</span> </span>
                    </div>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $showroom->name) }}"
                        placeholder="Showroom name eg. Nepal windoor Showroom" aria-label="Name" aria-describedby="basic-addon1"
                        required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Showroom address <span class="text-danger">*</span> </span>
                    </div>
                    <input type="text" class="form-control" name="address"
                        value="{{ old('address', $showroom->address) }}"
                        placeholder="Showroom address eg. Ward-10, Adarsh Nagar, Birgunj, Nepal-44300" aria-label="address"
                        aria-describedby="basic-addon1" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Tel Phone <span class="text-danger">*</span> </span>
                    </div>
                    <input type="text" class="form-control" name="tel_phone"
                        value="{{ old('tel_phone', $showroom->tel_phone) }}" placeholder="Tel-phone eg. 01-0000000"
                        aria-label="Tel-phone" aria-describedby="basic-addon1" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Mobile Phone</span>
                    </div>
                    <input type="text" class="form-control" name="phone"
                        value="{{ old('phone', $showroom->phone) }}" placeholder="Mobile Phone eg. +977-9800000000"
                        aria-label="Phone" aria-describedby="basic-addon1" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Email <span class="text-danger">*</span> </span>
                    </div>
                    <input type="text" class="form-control" name="email"
                        value="{{ old('email', $showroom->email) }}" placeholder="Email eg. example@gmail.com"
                        aria-label="email" aria-describedby="basic-addon1" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="display" value="1"
                                @if (old('display', $showroom->display) == 1) checked @endif></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <div class="alert alert-warning">
                    Best Image Size 1420 X 450 PX.
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Image</span>
                    </div>
                    <input type="file" name="image"
                        data-default-file="{{ asset('storage/showroom/' . $showroom->image) }}" class="dropify">
                </div>
            </div>


        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.showrooms.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" name="submit" class="btn btn-success"
            value="save">Save</button>
    </div>
</form>
