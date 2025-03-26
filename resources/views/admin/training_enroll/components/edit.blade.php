<form method="POST" action="{{ route('admin.training.update', $ad->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="card m-1">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-text-width"></i> &nbsp; Name
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{ old('name', $ad->name) }}"
                            name="name" placeholder="Training Name" />
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-9 mt-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-text-width"></i> &nbsp; Description
                            </span>
                        </div>
                        <textarea type="text" class="form-control" value="{{ old('description', $ad->description) }}"
                               name="description" placeholder="Training Name" >
                            {{$ad->description}}
                        </textarea>
                    </div>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-9 mt-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-text-width"></i> &nbsp; Date
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{ old('date', $ad->date) }}"
                               name="date" placeholder="Training Date" />
                    </div>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            </div>
        </div>
    </div>
    </div>
    <div class="clearfix"></div>
    <div class="row sticky-bottom">
        <div class="col-md-12 text-right">
            <a href="{{ route('admin.training.index') }}" class="btn btn-danger btn-sm">Cancel</a>

            <button type="submit" class="btn btn-primary btn-lg">
                Update Change
            </button>
        </div>
    </div>

    </div>
    </div>

</form>
