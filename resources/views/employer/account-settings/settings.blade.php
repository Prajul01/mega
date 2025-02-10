<?php
$employer = auth()->user()->employer;
$socialIcons = [];
if (@$employer->tiktok_url) {
    array_push($socialIcons, 'fab fa-tiktok');
}
if (@$employer->linkedIn_url) {
    array_push($socialIcons, 'fab fa-linkedin-in');
}
if (@$employer->youtube_url) {
    array_push($socialIcons, 'fab fa-youtube');
}
if (@$employer->instagram_url) {
    array_push($socialIcons, 'fab fa-instagram');
}
if (@$employer->facebook_url) {
    array_push($socialIcons, 'fab fa-instagram-f');
}
?>
@extends('employer.account-settings.layouts.app')
@section('title', 'Company Page Settings')
@section('dashboard-content')
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <form action="{{ route('employers.settings.savesPageSettings') }}" method="POST">
            @csrf
            <div class="tab-main-title">
                <span class="tab-icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </span> &nbsp;
                Company Page Settings
            </div>

            <div class="tab-main-content">

                <ul class="list-choices">

                    <li class="choice-li">
                        <div class="content-choice">
                            <span>Display Organization Ownership</span>
                        </div>
                        <div class="small-text">
                            <small>{{ $employer->ower_ship->title }}</small>
                        </div>
                        <div class="btn-container">
                            <label class="switch btn-color-mode-switch">
                                <input value="1" id="color_mode2" type="checkbox" name="ownership"
                                    {{ $settings->ownership ? 'checked' : '' }}>
                                <label class="btn-color-mode-switch-inner" data-off="NO" data-on="YES"
                                    for="color_mode2"></label>
                            </label>

                        </div>
                    </li>
                    <li class="choice-li">
                        <div class="content-choice">
                            <span>Display my Organization Size</span>
                        </div>
                        <div class="small-text">
                            <small>{{ $employer->company_size->title }} employees</small>
                        </div>
                        <div class="btn-container">
                            <label class="switch btn-color-mode-switch">
                                <input value="1" id="color_mode3" type="checkbox" name="size"
                                    {{ $settings->size ? 'checked' : '' }}>
                                <label class="btn-color-mode-switch-inner" data-off="NO" data-on="YES"
                                    for="color_mode3"></label>
                            </label>

                        </div>
                    </li>
                    <li class="choice-li">
                        <div class="content-choice">
                            <span>Display the Oraganization Summary</span>
                        </div>
                        <div class="small-text text">
                            <small>{!! strip_tags($employer->company_description) !!}</small>
                        </div>
                        <div class="btn-container">
                            <label class="switch btn-color-mode-switch">
                                <input value="1" id="color_mode4" type="checkbox" name="summary"
                                    {{ $settings->summary ? 'checked' : '' }}>
                                <label class="btn-color-mode-switch-inner" data-off="NO" data-on="YES"
                                    for="color_mode4"></label>
                            </label>

                        </div>
                    </li>
                    <li class="choice-li">
                        <div class="content-choice">
                            <span>Display the Oraganization Service</span>
                        </div>
                        <div class="small-text text">
                            <small>{!! strip_tags($employer->services) !!}</small>
                        </div>
                        <div class="btn-container">
                            <label class="switch btn-color-mode-switch">
                                <input value="1" id="color_modeservices" type="checkbox" name="services"
                                    {{ $settings->services ? 'checked' : '' }}>
                                <label class="btn-color-mode-switch-inner" data-off="NO" data-on="YES"
                                    for="color_modeservices"></label>
                            </label>

                        </div>
                    </li>
                    <li class="choice-li">
                        <div class="content-choice">
                            <span>Display Organization Address</span>
                        </div>
                        <div class="small-text">
                            <?php
                            if (@$employer->city->name == @$employer->district->name) {
                                $address = @$employer->city->name;
                            } else {
                                $address = @$employer->city->name . ', ' . @$employer->district->name;
                            }
                            ?>
                            <small>{{ $address }}</small>
                        </div>
                        <div class="btn-container">
                            <label class="switch btn-color-mode-switch">
                                <input value="1" id="color_mode5" name="address" type="checkbox"
                                    {{ $settings->address ? 'checked' : '' }}>
                                <label class="btn-color-mode-switch-inner" data-off="NO" data-on="YES"
                                    for="color_mode5"></label>
                            </label>

                        </div>
                    </li>

                    <li class="choice-li">
                        <div class="content-choice">
                            <span>Display the Social Accounts</span>
                        </div>
                        <div class="small-text">
                            <small>
                                @foreach ($socialIcons as $icons)
                                    <i class="{{ $icons }} mx-2"></i>
                                @endforeach
                            </small>
                        </div>
                        <div class="btn-container">
                            <label class="switch btn-color-mode-switch">
                                <input value="1" id="color_mode6" type="checkbox" name="social_accounts"
                                    {{ $settings->social_accounts ? 'checked' : '' }}>
                                <label class="btn-color-mode-switch-inner" data-off="NO" data-on="YES"
                                    for="color_mode6"></label>
                            </label>

                        </div>
                    </li>

                    <li class="choice-li">
                        <div class="content-choice">
                            <span>Display the Company Website</span>
                        </div>
                        <div class="small-text">
                            <small><a href="{{ $employer->company_website }}"
                                    target="_blank">{{ Str::limit($employer->company_website, 20) }}</a></small>
                        </div>
                        <div class="btn-container">
                            <label class="switch btn-color-mode-switch">
                                <input value="1" id="color_mode7" type="checkbox" name="website"
                                    {{ $settings->website ? 'checked' : '' }}>
                                <label class="btn-color-mode-switch-inner" data-off="NO" data-on="YES"
                                    for="color_mode7"></label>
                            </label>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-main-footer">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-hover">Save Changes
                </button>
                <button type="submit" name="submit" id="submit" class="btn btn-orange btn-hover">Cancel </button>
            </div>
        </form>
    </div>
@endsection
