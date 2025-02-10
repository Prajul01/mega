<form method="POST" action="{{ route('admin.advertisement.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card m-1">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-text-width"></i> &nbsp; Title
                            </span>
                        </div>
                        <input type="text" class="form-control" value="{{old('title')}}" name="title"
                            placeholder="advertisement Title" required/>

                    </div>
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="display" value="1" checked>
                            </div>
                        </div>
                        <input type="button " class="form-control bg-indigo text-muted" value="Display" disabled>
                    </div>
                    @error('display')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
               
                <div class="col-md-6 mt-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-arrow-up"></i> &nbsp; Type
                            </span>
                        </div>
                        <select class="form-select form-control" aria-label="Default select example" name="type" id="type">
                            <option selected disabled>Select Ads Type</option>
                            <option value="1" {{old('type')=='1'?'selected':''}}>Main Banner</option>
                            <option value="2" {{old('type')=='2'?'selected':''}}>Side Bar Video</option>
                            <option value="3" {{old('type')=='3'?'selected':''}}>Side Bar Image</option>
                          </select>  
                    @error('type')
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


