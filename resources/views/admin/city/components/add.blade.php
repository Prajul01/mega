<form method="POST" action="{{ route('admin.city.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">City Name</span>
                    </div>
                    <input type="text" class="form-control" name="city_name" placeholder="City Name" aria-label="Title"
                        aria-describedby="basic-addon1" value="{{old('city_name')}}" required>
                </div>
                @error('city_name')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                checked></span>
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
                        <span class="input-group-text">District Name</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="district_name">
                        <option selected disabled value="">Select District</option>
                        @foreach($districts as $district)
                        <option value="{{$district->id}}" {{old('district_name')==$district->id?"selected":''}}>{{$district->name}}</option>
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
        <a href="{{ route('admin.city.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>