<form method="POST" action="{{ route('admin.concern.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Concern</span>
                    </div>
                    <input type="text" class="form-control" name="concern" placeholder="Concern" aria-label="concern"
                        aria-describedby="basic-addon1" value="{{old('concern')}}" required>
                </div>
                @error('concern')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="display"
                                {{ old('display')? (old('display')? 'checked': ''): 'checked' }}></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                @error('status')
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
