@extends('admin.layouts.app')
@section('title', 'Site Info Management')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Site Info Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Site Info Management</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="card custom-card">
                    @can('site-edit')
                        <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
                            @csrf
                        @endcan
                        <div class="body">
                            <div class="col-lg-12 gray-background py-3 d-flex justify-content-between flex-wrap">
                                <h6 class="custom-heading custom-color mb-0 p-1"><i class="fa fa-info-circle"
                                        aria-hidden="true"></i> Update Your Site Information</h6>
                            </div>

                            <div class="info-wrapper">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    &nbsp;Site Title
                                                </span>
                                            </div>
                                            <input type="text" name="site_title" class="form-control" aria-label="Small"
                                                aria-describedby="inputGroup-sizing-sm" placeholder="Enter Site Title"
                                                value=" {{ $setting->site_title }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;Email</span>
                                            </div>
                                            <input type="text" name="site_email" class="form-control" aria-label="Small"
                                                aria-describedby="inputGroup-sizing-sm" placeholder="Enter Email"
                                                value="{{ $setting->site_email }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-phone" aria-hidden="true"></i>&nbsp;Phone</span>
                                            </div>
                                            <input type="text" name="phone" class="form-control" aria-label="Small"
                                                aria-describedby="inputGroup-sizing-sm" placeholder="Enter Phone No"
                                                value="{{ $setting->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-phone" aria-hidden="true"></i>&nbsp;Mobile</span>
                                            </div>
                                            <input type="text" name="mobile" class="form-control" aria-label="Small"
                                                aria-describedby="inputGroup-sizing-sm" placeholder="Enter MObile No"
                                                value="{{ $setting->mobile }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-facebook" aria-hidden="true"></i>&nbsp;Facebook
                                                    Url</span>
                                            </div>
                                            <input type="text" name="facebook_url" class="form-control"
                                                aria-label="Small" aria-describedby="inputGroup-sizing-sm"
                                                placeholder="Enter Facebook Url" value="{{ $setting->facebook_url }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-instagram" aria-hidden="true"></i>&nbsp;Instagram
                                                    Url</span>
                                            </div>
                                            <input type="text" name="instagram_url" class="form-control"
                                                aria-label="Small" aria-describedby="inputGroup-sizing-sm"
                                                placeholder="Enter Instagram Url" value="{{ $setting->instagram_url }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-twitter" aria-hidden="true"></i>&nbsp;Twitter
                                                    Url</span>
                                            </div>
                                            <input type="text" name="twitter_url" class="form-control"
                                                aria-label="Small" aria-describedby="inputGroup-sizing-sm"
                                                placeholder="Enter Twitter Url" value="{{ $setting->twitter_url }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-youtube-play" aria-hidden="true"></i>&nbsp;Youtube
                                                    Url</span>
                                            </div>
                                            <input type="text" name="youtube_url" class="form-control"
                                                aria-label="Small" aria-describedby="inputGroup-sizing-sm"
                                                placeholder="Enter Youtube Url" value="{{ $setting->youtube_url }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-linkedin" aria-hidden="true"></i>&nbsp;LinkedIn
                                                    Url</span>
                                            </div>
                                            <input type="text" name="linkedin_url" class="form-control"
                                                aria-label="Small" aria-describedby="inputGroup-sizing-sm"
                                                placeholder="Enter LinkedIn Url" value="{{ $setting->linkedin_url }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-map-marker"
                                                        aria-hidden="true"></i>&nbsp;Address</span>
                                            </div>
                                            <textarea name="address" id="" cols="30" rows="3" class="form-control">{{ old('address', @$setting->address) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text"><i class="fa fa-map-o"
                                                        aria-hidden="true"></i>&nbsp;Google Map Url</span>
                                            </div>
                                            <textarea class="form-control" rows=3 name="google_map_url" aria-label="With textarea">{!! $setting->googlemap_url !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 gray-background py-3 d-flex justify-content-between flex-wrap">
                                <h6 class="custom-heading custom-color mb-0 p-1"><i class="fa fa-camera"
                                        aria-hidden="true"></i> Update Your
                                    Site
                                    Images</h6>
                            </div>
                            <br>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend custom-input-prepend mb-2">
                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                    class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;Website
                                                Logo</span>
                                        </div>
                                        <input type="file" name="logo"
                                            data-default-file="{{ asset('storage/setting/logo/' . $setting->logo) }}"
                                            class="dropify">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend custom-input-prepend mb-2">
                                            <span class="input-group-text " id="inputGroup-sizing-sm"><i
                                                    class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;Website
                                                Favicon</span>
                                        </div>
                                        <input type="file" name="favicon"
                                            data-default-file="{{ asset('storage/setting/favicon/' . $setting->favicon) }}"
                                            class="dropify">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 gray-background py-3 d-flex justify-content-between flex-wrap">
                                <h6 class="custom-heading custom-color mb-0 p-1"><i class="fa fa-globe"
                                        aria-hidden="true"></i> Update Your Website Meta Information</h6>
                            </div>
                            <br>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend custom-input-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Meta
                                                Title</span>
                                        </div>
                                        <input type="text" name="meta_title" class="form-control" aria-label="Small"
                                            aria-describedby="inputGroup-sizing-sm" placeholder="Enter OG Title"
                                            value="{{ old('meta_title', @$setting->meta_title) }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend custom-input-prepend">
                                            <span class="input-group-text"><i class="fa fa-file-text-o"
                                                    aria-hidden="true"></i>&nbsp;Meta Content</span>
                                        </div>
                                        <textarea class="form-control" rows=4 name="meta_content" aria-label="With textarea">{{ old('meta_content', @$setting->meta_description) }}</textarea>
                                    </div>
                                    <span class="alert alert-warning">Please enter 155 - 160 words for better
                                        results</span>
                                </div>
                            </div>

                            <div class="col-lg-12 gray-background py-3 d-flex justify-content-between flex-wrap">
                                <h6 class="custom-heading custom-color mb-0 p-1"><i class="fa fa-globe"
                                        aria-hidden="true"></i> Open Graph Setup for website</h6>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;OG
                                                    Title</span>
                                            </div>
                                            <input type="text" name="og_title" class="form-control"
                                                aria-label="Small" aria-describedby="inputGroup-sizing-sm"
                                                placeholder="Enter OG Title"
                                                value="{{ old('og_title', @$setting->og_title) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend custom-input-prepend">
                                                <span class="input-group-text"><i class="fa fa-file-text-o"
                                                        aria-hidden="true"></i>&nbsp;OG Content</span>
                                            </div>
                                            <textarea class="form-control" rows=4 name="og_content" aria-label="With textarea">{{ old('og_content', @$setting->og_description) }}</textarea>
                                        </div>
                                        <span class="alert alert-warning">Please enter 155 - 160 words for better
                                            results</span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend custom-input-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                    class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp;OG
                                                Images</span>
                                        </div>
                                        <input type="file"
                                            data-default-file="{{ asset('storage/setting/og-image/' . $setting->og_image) }}"
                                            name="og_image" class="dropify">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="col-md-12">
                                <a href="{{ route('admin.setting.index') }}" class="btn btn-outline-danger">Cancel</a>
                                @can('site-edit')
                                    <button style="float: right" type="submit" class="btn btn-outline-success">Save</button>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
@endpush
