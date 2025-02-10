<?php
$employer = auth()->user()->employer;
if (isset(auth()->user()->employer->logo)) {
    $url = asset('storage/employer/logo' . auth()->user()->employer->logo);
} else {
    $url = asset('frontend/assets/images/files/company-logo.png');
}
?>
@extends('employer.edit-profile.layouts.app')
@section('title', 'Social Account')
@section('dashboard_content')
    <div class="col-lg-9 col-md-8">
        <div class="card candidate-info new-shadow-sidebar mt-4 mb-3 mt-lg-0">
            <div class="card-body p-3">
                <div class="right-side-top-bar">
                    <div class="right-top-title">
                        <span class="icon-top">
                            <i class="fa-solid fa-share-nodes"></i>
                        </span>
                        Social Account
                    </div>
                </div>

                <form action="{{ route('employers.editProfile.saveSocialLinks') }}" method="POST">
                    @csrf
                    <div class="right-side-form social-card">
                        <div class="detail-form-content">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="facebook-url">Facebook
                                        </label>
                                        <div class="form-control-wrap">
                                            <div class="absolute-icon facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </div>
                                            <input type="text" class="form-control" id="facebook-url" name="facebook_url"
                                                value="{{ @$employer->facebook_url }}" placeholder="Enter Facebook URL"
                                                value="{{ @$employer->facebook_url }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="instagram-url">Instagram
                                        </label>
                                        <div class="form-control-wrap">
                                            <div class="absolute-icon insta">
                                                <i class="fab fa-instagram"></i>
                                            </div>
                                            <input type="text" class="form-control" id="instagram-url"
                                                name="instagram_url" placeholder="Enter Instagram URL"
                                                value="{{ @$employer->instagram_url }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="youtube-url">Youtube
                                        </label>
                                        <div class="form-control-wrap">
                                            <div class="absolute-icon youtube">
                                                <i class="fab fa-youtube"></i>
                                            </div>
                                            <input type="text" class="form-control" id="youtube-url" name="youtube_url"
                                                placeholder="Enter Youtube URL" value="{{ @$employer->youtube_url }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="linkedin-url">Linkedin
                                        </label>
                                        <div class="form-control-wrap">
                                            <div class="absolute-icon linkedin">
                                                <i class="fab fa-linkedin-in"></i>
                                            </div>
                                            <input type="text" class="form-control" id="linkedin-url" name="linkedIn_url"
                                                placeholder="Enter LinkedIn URL" value="{{ @$employer->linkedIn_url }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="tktok-url">Tiktok
                                        </label>
                                        <div class="form-control-wrap">
                                            <div class="absolute-icon tiktok">
                                                <i class="fab fa-tiktok"></i>
                                            </div>
                                            <input type="text" class="form-control" id="tktok-url" name="tiktok_url"
                                                placeholder="Enter Tiktok URL" value="{{ @$employer->tiktok_url }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <br>
                            <div class="education-footer-btn">
                                <div class="text-left">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                        Save Experience </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
