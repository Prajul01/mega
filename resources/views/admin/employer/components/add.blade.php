@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
<form method="POST" action="{{ route('admin.employer.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Name</span>
                    </div>
                    <input type="text" class="form-control" name="company_name" placeholder="Company Name" aria-label=""
                        aria-describedby="basic-addon1" value="{{old('company_name')}}" required>
                </div>
                @error('company_name')
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
                        <span class="input-group-text">Phone Number</span>
                    </div>
                    <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" aria-label=""
                        aria-describedby="basic-addon1" value="{{old('phone_number')}}">
                </div>
                @error('phone_number')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Office Number</span>
                    </div>
                    <input type="text" class="form-control" name="office_number" placeholder="Office Number" aria-label=""
                        aria-describedby="basic-addon1" value="{{old('office_number')}}">
                </div>
                @error('office_number')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Logo</span>
                    </div> 
                    <input type="file" name="company_logo" class="dropify" data-default-file="{{ old('company_logo') }}">
                </div>
                @error('company_logo')
                <span class="error">{{$message}}</span>
                @enderror
                <div class="alert alert-warning mt-1">
                    Best Image Size 1200 X 600 PX.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Image</span>
                    </div>
                    <input type="file" name="image" class="dropify" data-default-file="{{ old('image') }}">
                </div>
                @error('image')
                <span class="error">{{$message}}</span>
                @enderror
                <div class="alert alert-warning mt-1">
                    Best Image Size 1200 X 600 PX.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Email</span>
                    </div>
                    <input type="text" class="form-control" name="email" placeholder="Email" aria-label=""
                        aria-describedby="basic-addon1" value="{{old('email')}}">
                </div>
                @error('email')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Address</span>
                    </div>
                    <input type="text" class="form-control" name="address" placeholder="Address" aria-label=""
                        aria-describedby="basic-addon1" value="{{old('address')}}">
                </div>
                @error('address')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Expiery Date</span>
                    </div>
                    <input type="date" class="form-control" name="expiry_date" placeholder="Expiry Date" id="date" aria-label=""
                        aria-describedby="basic-addon1" value="{{old('expiry_date')}}">
                </div>
                @error('expiry_date')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="is_verify" value="1"
                                checked></span>
                    </div>
                    <input type="text" class="form-control" value="Is Company Verified!" disabled>
                </div>
                @error('is_verify')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Company Owner Ships</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="company_owner_ship">
                        <option selected disabled value="">Select Company Owner Ships</option>
                        @foreach($company_owner_ships as $company_owner_ship)
                        <option value="{{$company_owner_ship->id}}" {{old('company_owner_ship')==$company_owner_ship->id?'selected':''}}>{{$company_owner_ship->title}}</option>
                        @endforeach
                      </select>
                </div>
                @error('company_owner_ship')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Company Size</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="company_size">
                        <option selected disabled value="">Select Company Size</option>
                        @foreach($company_sizes as $company_size)
                        <option value="{{$company_size->id}}" {{old('company_size')==$company_size->id?'selected':''}}>{{$company_size->title}}</option>
                        @endforeach
                      </select>
                </div>
                @error('company_size')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select User</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="user">
                        <option selected disabled value="">Select User</option>
                        
                        @foreach($users as $user)
                        <option value="{{$user->id}}" {{old('user')==$user->id?'selected':''}}>{{$user->name}}</option>
                        @endforeach
                      </select>
                </div>
                @error('user')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Company Category</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="company_category">
                        <option selected disabled value="">Select Company Category</option>
                        @foreach($company_categories as $company_category)
                        <option value="{{$company_category->id}}" {{old('company_category')==$company_category->id?'selected':''}}>{{$company_category->title}}</option>
                        @endforeach
                      </select>
                </div>
                @error('company_category')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Website Url</span>
                    </div>
                    <textarea class="form-control" name="company_website" placeholder="Company Website Url" aria-label=""
                        aria-describedby="basic-addon1">{{old('company_website')}}</textarea>
                </div>
                @error('company_website')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Description</span>
                    </div>
                    <textarea class="form-control" id="ckeditor" name="company_description" placeholder="Company description" rows="6" aria-label=""
                        aria-describedby="basic-addon1">{{old("company_description")}}</textarea>
                </div>
                @error('company_description')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Additional Information</span>
                    </div>
                    <textarea class="form-control" id="ckeditor1" name="additional_info" placeholder="Additional Information" rows="6" aria-label=""
                        aria-describedby="basic-addon1">{{old("additional_info")}}</textarea>
                </div>
                @error('additional_info')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header">
                    <h2>Address</h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Country</span>
                    </div>
                    <select class="form-select form-control country" aria-label="Default select example" name="country">
                        <option selected disabled value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}" {{old('country')==$country->id?'selected':''}}>{{$country->name}}</option>
                        @endforeach
                      </select>
                </div>
                @error('country')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Province</span>
                    </div>
                    <select class="form-select form-control province-list" id="province" aria-label="Default select example" name="province">
                        {{-- @foreach($provinces as $province)
                        <option value="{{$province->id}}" {{old('province')==$province->id?'selected':''}}>{{$province->name}}</option>
                        @endforeach --}}
                      </select>
                </div>
                @error('province')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select District</span>
                    </div>
                    <select class="form-select form-control district-list" aria-label="Default select example" name="district" id="district">
                       
                        {{-- @foreach($districts as $district)
                        <option value="{{$district->id}}" {{old('district')==$district->id?'selected':''}}>{{$district->name}}</option>
                        @endforeach --}}
                      </select>
                </div>
                @error('province')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select City</span>
                    </div>
                    <select class="form-select form-control city-list" aria-label="Default select example" name="city">
                        {{-- <option selected disabled value="">Select City</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}" {{old('city')==$city->id?'selected':''}}>{{$city->name}}</option>
                        @endforeach --}}
                      </select>
                </div>
                @error('city')
                <span class="error">{{$message}}</span>
                @enderror
            </div>
           
         
           
           
          
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header">
                    <h2>Contact Personal Information</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <div class="row mb-2 border p-2 mx-2">
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" name="personal_name[]" placeholder="Personal Name" required/>
                        </div>
                        @error('personal_name.*')
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email</span>
                            </div>
                            <input type="text" class="form-control" name="personal_email[]" placeholder="Personal Email" required/>
                        </div>
                        @error('personal_email.*')
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Designation</span>
                            </div>
                            <input type="text" class="form-control" name="personal_designation[]" placeholder="Personal Designation" required/>
                        </div>
                        @error('personal_designation.*')
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone Number</span>
                            </div>
                            <input type="text" class="form-control" name="personal_phone[]" placeholder="Personal Phone" required/>
                        </div>
                        @error('personal_phone.*')
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="additional_personal_info">

                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary add-personal-info">Add More <i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h2>Social link</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <?php
                    $socialLinks = ['tiktok', 'linkedIn', 'youtube', 'instagram', 'facebook']
                ?>
                @foreach($socialLinks as $social)
                <?php
                    $inputName = $social . '_url';
                ?>
                <div class="row mb-2">
                    <div class="col-md-3">
                        <input class="form-control" value="{{ ucfirst($social) }} URL" disabled />
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Link</span>
                            </div>
                            <input type="text" class="form-control" name="{{ $inputName }}" placeholder="{{ ucfirst($social) }} URL" required/>
                        </div>
                        @error($inputName)
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                @endforeach
            </div>

            
        </div>
    </div>
   
    <div class="card-footer">
        <a href="{{ route('admin.employer.index') }}" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>

@push('script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script src="{{ asset('backend/assets/vendor/select2/dist/js/select2.js') }}"></script>
    <script>
        $(document).on('click', '#remove', function() {
            $(this).closest(".varient").remove();
        });
    </script>
      <script>
        $(".add-personal-info").click(function() {
            $(".additional_personal_info").append(
              `  <div class="row mb-2 personal border p-2 mx-2">
                <div class="col-md-12 float-right my-2"><span id="remove_personal" class="remove btn btn-outline-danger"><i class="fa fa-trash"></i></span> </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" name="personal_name[]" required/>
                        </div>
                        @error('personal_name.*')
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email</span>
                            </div>
                            <input type="text" class="form-control" name="personal_email[]" required/>
                        </div>
                        @error('personal_email.*')
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Designation</span>
                            </div>
                            <input type="text" class="form-control" name="personal_designation[]" required/>
                        </div>
                        @error('personal_designation.*')
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone Number</span>
                            </div>
                            <input type="text" class="form-control" name="personal_phone[]" required/>
                        </div>
                        @error('personal_phone.*')
                        <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                </div>`
            )
        });
        $(document).on('click', '#remove_personal', function() {
            $(this).closest(".personal").remove();
        });
    </script>
    <script>
        var editor_config = {
            toolbar: [{
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']
                   
                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', '-', 'JustifyLeft',
                        'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                    ]
                },
                {
                    name: 'links',
                    items: ['Link']
                },
                '/',
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor']
                },
            ],
            width: ['100%']
        };
        CKEDITOR.replace('ckeditor', editor_config);
        CKEDITOR.replace('ckeditor1', editor_config);
    </script>
    <script>
        $(document).ready(function() {
            $('.multiple-cat').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".country").on('blur', function() {
                var _country_id = $(this).val();
                $.ajax({
                    url: "{{ url('admin/employer-management/provincelist') }}/" + _country_id,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".province-list").html(
                            '<option selected diaslable>--- Select Province ---</option>');
                    },
                    success: function(data) {
                        var _html = '';
                        $.each(data.response, function(index, row) {
                            _html += '<option value="' + row.id + '">' + row.name +
                                '</option>';
                        });
                        $(".province-list").html(_html);
                    }
                });

            });
        });
        </script>
         <script>
            $(document).ready(function() {
                $("#province").on('blur', function() {
                    var _district_id = $(this).val();
                    $.ajax({
                        url: "{{ url('admin/employer-management/districtlist') }}/" + _district_id,
                        dataType: 'json',
                        beforeSend: function() {
                            $(".district-list").html(
                                '<option selected diaslable>--- Select District ---</option>');
                        },
                        success: function(data) {
                            var _html = '';
                            $.each(data.response, function(index, row) {
                                _html += '<option value="' + row.id + '">' + row.name +
                                    '</option>';
                            });
                            $(".district-list").html(_html);
                        }
                    });
    
                });
            });
            </script>
             <script>
                $(document).ready(function() {
                    $("#district").on('blur', function() {
                        var _city_id = $(this).val();
                        $.ajax({
                            url: "{{ url('admin/employer-management/citylist') }}/" + _city_id,
                            dataType: 'json',
                            beforeSend: function() {
                                $(".city-list").html(
                                    '<option selected diaslable>--- Select City ---</option>');
                            },
                            success: function(data) {
                                var _html = '';
                                $.each(data.response, function(index, row) {
                                    _html += '<option value="' + row.id + '">' + row.name +
                                        '</option>';
                                });
                                $(".city-list").html(_html);
                            }
                        });
        
                    });
                });
                </script>
@endpush
