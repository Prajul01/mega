@extends('user.layout.master')
@section('title', 'Sign up as Employer')
@section('content')
    <div class="page-content">

        <!-- START SIGN-IN -->
        <section class="bg-auth">
            <div class="container-fluid custom-container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <div class="card auth-box">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="employer-signup card-body p-5 h-100">
                                        <div class="w-100">
                                            <div class="text-center mb-4">
                                                <h5 class="welcome-heading">Create an Employer Account</h5>
                                                <p class="text-white-70">Fill out the necessary information to
                                                    begin hiring right away! You are one step away from hiring
                                                    your ideal worker.</p>
                                            </div>
                                            <form action="{{ route('employers.register') }}" method="POST"
                                                id="registerForm" class="">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="organizationInput" class="form-label">Organization
                                                            Name</label>
                                                        <input type="text" name="organization_name" class="form-control"
                                                            id="organizationInput" placeholder="Enter your organization"
                                                            value="{{ old('organization_name') }}" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="industryInput" class="form-label">Organization Industry
                                                            Type</label>
                                                        <select name="organization_industry" id=""
                                                            class="form-control field-industry">
                                                            <option
                                                                value=""{{ old('organization_industry') ? '' : 'selected' }}
                                                                disabled>--Select--
                                                            </option>
                                                            @php
                                                                $companyTypes = \App\Models\CompanyCategory::all();
                                                            @endphp
                                                            @foreach ($companyTypes as $type)
                                                                <option value="{{ $type->slug }}"
                                                                    {{ old('organization_industry') == $type->id ? 'selected' : '' }}>
                                                                    {{ $type->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="contactInput" class="form-label">Contact
                                                            Person Name</label>
                                                        <input type="text" class="form-control" id="contactInput"
                                                            placeholder="Enter your contact" name="contact_person_name"
                                                            required {{ old('contact_person_name') }}>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="addressInput" class="form-label">Company
                                                            Address</label>
                                                        <input type="text" class="form-control" id="addressInput"
                                                            placeholder="Enter your address" required name="company_address"
                                                            value="{{ old('company_address') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="EmailInput" class="form-label">Email
                                                            Address</label>
                                                        <input type="email" class="form-control" id="EmailInput"
                                                            placeholder="Enter your Email" required name="email"
                                                            value="{{ old('email') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="officeInput" class="form-label">
                                                            Office Contact</label>
                                                        <input type="text" class="form-control" id="officeInput"
                                                            placeholder="Enter your office" required name="office_contact"
                                                            value="{{ old('office_contact') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="numberInput" class="form-label">Mobile
                                                            number
                                                        </label>
                                                        <input type="text" class="form-control" id="numberInput"
                                                            placeholder="Enter your number" name="mobile_number" required
                                                            value="{{ old('mobile_number') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="signupUsername" class="form-label">
                                                            Username
                                                        </label>
                                                        <input type="text" class="form-control" id="signupUsername"
                                                            placeholder="Enter your username" required name="username"
                                                            value="{{ old('username') }}">
                                                        <span class id="response"
                                                            style="margin-top:10px!important; display: none;"></span>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="passwordInput" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="passwordInput"
                                                            placeholder="Enter your password" required name="password">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="confirmInput" class="form-label">Confirm
                                                            Password</label>
                                                        <input type="password" class="form-control" id="confirmInput"
                                                            placeholder="confirm password" required
                                                            name="confirm_password">
                                                    </div>
                                                    <div class="col-12 mb-4">
                                                        <div class="form-check"><input class="form-check-input"
                                                                type="checkbox" id="checker" name="terms" checked>
                                                            <label class="form-check-label" for="flexCheckDefault"
                                                                name="flexCheckDefault" id="terms">I
                                                                agree to the <a href="{{ route('terms') }}">Terms &
                                                                    Conditions</a> and
                                                                <a href="{{ route('privacy') }}">Privacy</a> of Megajob
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @if (config('services.recaptcha.site_key'))
                                                        <div class="g-recaptcha mb-2"
                                                            data-sitekey="{{ config('services.recaptcha.site_key') }}">
                                                        </div>
                                                    @endif
                                                    <div class="clearfix"></div>
                                                    <br>
                                                    <div class="col-12">
                                                        <div class="text-center">
                                                            <button type="button" class="btn btn-primary btn-hover"
                                                                onclick="registerForm()">Create An
                                                                Account</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Already have an employer account ? <a
                                                        href="{{ route('employers.login') }}"
                                                        class="fw-medium text-decoration-underline">
                                                        Log in </a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end auth-box-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </section>
        <!-- END SIGN-IN -->

    </div>
    <!-- End Page-content -->
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".field-study, .field-industry").select2({
            tags: true
        });
    </script>
    <script>
        function registerForm() {

            if ($('#checker').is(':checked')) {
                $('#registerForm').submit();
            } else {
                $('#terms').addClass('text-danger');
                toastr.error('Accept Terms and Conditions');
            }

        }
    </script>
    <script>
        $('#signupUsername').on('change', function() {
            var username = $('#signupUsername').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ route('employers.userNameValidate') }}',
                data: {
                    'username': username,
                },
                success: function(data) {
                    if (data['valid'] == 1) {
                        $('#response').removeAttr('class');
                        $('#response').attr('class', 'text-success');
                        $('#response').html('This Username is valid');
                        $('#response').attr('style',
                            'margin-top:5px !important; display:block !important;');
                    }

                    if (data['valid'] == 0) {
                        $('#response').removeAttr('class');
                        $('#response').attr('class', 'text-danger');
                        $('#response').html(
                            'This Username already exists! You can try <span class="btn btn-sm btn-success" id="n-name" onclick="changeUsername(this)">' +
                            data['suggestions'] + '</span>');
                        $('#response').attr('style',
                            'margin-top:5px !important;display:block !important;');
                    }
                }
            });
        });

        function changeUsername(data) {
            var name = $('#n-name').text()
            $('#signupUsername').val(name);
        }
    </script>
@endpush
