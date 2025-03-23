<form method="POST" action="{{ route('admin.training.store') }}" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" value="{{old('name')}}" name="name"
                            placeholder="Training Name" required/>

                    </div>
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-9 m-t-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-text-width"></i> &nbsp; Name
                            </span>
                        </div>
                        <textarea type="text" class="form-control" value="{{old('description')}}" name="description"
                               placeholder="Training Name" >

                        </textarea>

                    </div>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-9 m-t-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-text-width"></i> &nbsp; Name
                            </span>
                        </div>
                        <input type="date" class="form-control" value="{{old('date')}}" name="date"
                               placeholder="Training Name" required/>


                    </div>
                    @error('date')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>



                </div>

            </div>
        </div>
    </div>
    <div class="card image" >
        <div class="card-header">
            <label class="title mb-0" style="font-size: 12px;">
                <b>Images</b>
            </label>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-image fa-lg"></i> &nbsp;
                                Image
                            </span>
                        </div>
                        <input type="file" name="image" class="bg-primary text-white form-control dropify" value="{{old('image')}}">
                    </div>
                    @error('image')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div style="font-size: 12px; color: gray;">
                        <small><strong>Recommended Image</strong></small><br>
                        <small class="big">Resolution : <strong>1500px X
                                300px</strong></small><br>
                        <small class="big">Accept : <strong>png,jpg,jpeg</strong></small><br>
                        <small class="small">Resolution : <strong>300px X
                            150px</strong></small><br>
                        <small class="small">Accept : <strong>png,jpg,jpeg,gif</strong></small><br>
                        <small>File Size : <strong>Smaller than or Equal to 9MB
                                ( ≤ 9MB)</strong></small>
                    </div>


                </div>
                  <div class="col-md-12 mt-2 link">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-link"></i> &nbsp; link
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{old('link')}}" name="link"
                            placeholder="enter link"/>

                    </div>
                    @error('link')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


            </div>
        </div>
    </div>
    <div class="card url">
        <div class="card-header">
            <label class="title mb-0" style="font-size: 12px;">
                <b>Advertisement Youtube Url</b>
            </label>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-link"></i> &nbsp; Url (Youtube link)
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{old('url')}}" name="url"
                            placeholder="enter url"/>

                    </div>
                    @error('url')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
          </div>
        </div>
    </div>



    <div class="clearfix"></div>
    <div class="row sticky-bottom">
        <div class="col-md-12 text-right">
            <a href="{{route('admin.advertisement.index')}}" class="btn btn-danger btn-sm">Cancel</a>

            <button type="submit" class="btn btn-primary btn-lg">
                Save Change
            </button>
        </div>
    </div>
</form>


