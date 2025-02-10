@extends('employer.account-settings.layouts.app')
@section('title', 'Change Password')
@section('dashboard-content')
    <div class="tab-pane fade active show" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
        <div class="tab-main-title">
            <span class="tab-icon">
                <i class="fa-solid fa-key"></i>
            </span> &nbsp;
            Change Password
        </div>
        <form method="post" action="{{ route('employers.settings.change-password') }}" onsubmit="return validateForm()"
            class="contact-form mt-4" name="myForm" id="myForm">
            @csrf
            <div class="tab-main-content">
                <span id="error-msg"></span>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3 position-relative">
                            <label for="nameInput" class="form-label">Current
                                Password</label>

                            <a href="{{ route('employers.forget.password.get') }}" class="float-forget">Forgot
                                Password?</a>

                            <input type="password" name="old_password" id="name" class="form-control password-input"
                                placeholder="Enter your old password">
                             <div class="eye-btn">
                                                                <span class="show-eye d-none">
                                                                    <i class="fa-solid fa-eye"></i></span>
                                                                <span class="hide-eye">
                                                                    <i class="fa-solid fa-eye-slash"></i></span>
                                                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-6">
                        <div class="mb-3 position-relative">
                            <label for="passwordInput" class="form-label">New
                                Password</label>
                            <input type="password" class="form-control password-input" id="emaiol" name="password"
                                placeholder="Enter your new password">
                             <div class="eye-btn">
                                                                <span class="show-eye d-none">
                                                                    <i class="fa-solid fa-eye"></i></span>
                                                                <span class="hide-eye">
                                                                    <i class="fa-solid fa-eye-slash"></i></span>
                                                            </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-6">
                        <div class="mb-3 position-relative">
                            <label for="passwordInput" class="form-label">Confirm
                                Password</label>
                            <input type="password" class="form-control password-input" id="emaiol" name="confirm_password"
                                placeholder="Re enter your new password">
                             <div class="eye-btn">
                                                                <span class="show-eye d-none">
                                                                    <i class="fa-solid fa-eye"></i></span>
                                                                <span class="hide-eye">
                                                                    <i class="fa-solid fa-eye-slash"></i></span>
                                                            </div>
                        </div>
                    </div><!--end col-->
                </div>
            </div>
            <hr>
            <div class="tab-main-footer">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-hover">Save Changes
                </button>
                <button type="submit" name="submit" id="submit" class="btn btn-orange btn-hover">Cancel </button>
            </div>
        </form>

    </div>
@endsection
