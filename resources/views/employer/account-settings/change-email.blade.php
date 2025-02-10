@extends('employer.account-settings.layouts.app')
@section('title', 'Change Email')
@section('dashboard-content')
    <div class="tab-main-title">
        <span class="tab-icon">
            <i class="fa-regular fa-envelope"></i>
        </span> &nbsp;
        Change Email Address
    </div>
    <form action="{{ route('employers.settings.editEmails') }}" method="POST">
        @csrf
        <div class="tab-main-content tab-panes mb-3">
            <p>The following e-mail addresses re associated with your account:
            </p>
            <hr>
            <h6 class="mt-3">Please fill up your form to change your email
                address.</h6>
            @foreach ($emails as $email)
                <input type="radio" id="{{ $email->id }}" name="email" value="{{ base64_encode($email->id) }}">
                <label for="{{ $email->id }}">{{ $email->email }} <span
                        class="{{ @$email->email_verified_at ? 'verified' : 'unverified' }}"><i
                            class="{{ @$email->email_verified_at ? 'fa-regular fa-circle-check' : 'fa fa-times' }}"></i>
                        {{ @$email->email_verified_at ? 'Verified' : 'Unverified' }}</span>
                    @if ($email->is_primary)
                        <span class="primary">Primary</span>
                    @endif

                </label>
                <br>
            @endforeach
            <hr>
            <div class="tab-main-footer">
                <button type="submit" name="submit" value="primary" id="submit" class="btn btn-primary btn-hover">Make
                    Primary
                </button>
                <button type="submit" name="submit" id="submit" value="remove" class="btn btn-orange btn-hover">Remove
                </button>
            </div>
        </div>
    </form>
    
    <form method="post" action="{{ route('employers.settings.addEmails') }}" onsubmit="return validateForm()"
        class="contact-form mt-4" name="myForm" id="myForm">
        @csrf
        <div class="tab-main-content tab-panes">
            <h5 class="">Add Email Address</h5>
            <hr>

            <span id="error-msg"></span>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">
                            Email</label>
                        <input type="email" class="form-control" id="emaiol" name="email"
                            placeholder="Enter your new email">
                    </div>
                </div><!--end col-->
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
