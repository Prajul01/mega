<?php
$employer = auth()->user()->employer;
if (isset(auth()->user()->employer->logo)) {
    $url = asset('storage/employer/logo' . auth()->user()->employer->logo);
} else {
    $url = asset('frontend/assets/images/files/company-logo.png');
}
?>
@extends('employer.edit-profile.layouts.app')
@section('title', 'Contact Person')
@section('dashboard_content')
    <div class="col-lg-9 col-md-8">
        <div class="card candidate-info new-shadow-sidebar mt-4 mb-3 mt-lg-0">
            <div class="card-body p-3">
                <div class="right-side-top-bar">
                    <div class="right-top-title">
                        <span class="icon-top">
                            <i class="fa-regular fa-address-card"></i>

                        </span>

                        Contact Person
                    </div>
                    <div class="right-top-button">
                        <a href="javascript:void(0)" name="submit" id="editPreference"
                            class="btn btn-primary btn-hover"><span class="icon-top">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span><span class="mobile-none">Edit Contact Person Info</span></a>
                    </div>
                </div>

                <div class="right-side-content">
                    <div class="basic-job-desc">
                        @if (@$employer->contact_persons_information)
                            <?php
                            $infos = json_decode(@$employer->contact_persons_information);
                            $name = $infos->name;
                            $email = $infos->email;
                            $designation = $infos->designation;
                            $mobile = $infos->number;
                            
                            $count = count($name);
                            ?>
                            <div class="detail-show-content">
                                @for ($i = 0; $i < $count; $i++)
                                    <div class="basic-job-list">
                                        <div class="basic-job-left">
                                            Full Name
                                        </div>
                                        <div class="basic-job-right">
                                            <strong>{{ $name[$i] }}</strong>
                                        </div>
                                    </div>
                                    <div class="basic-job-list">
                                        <div class="basic-job-left">
                                            Mobile Number
                                        </div>
                                        <div class="basic-job-right">
                                            {{ $mobile[$i] }}
                                        </div>
                                    </div>
                                    <div class="basic-job-list">
                                        <div class="basic-job-left">
                                            Email
                                        </div>
                                        <div class="basic-job-right">
                                            {{ $email[$i] }}
                                        </div>
                                    </div>

                                    <div class="basic-job-list">
                                        <div class="basic-job-left">
                                            Designation
                                        </div>
                                        <div class="basic-job-right">
                                            {{ $designation[$i] }}
                                        </div>
                                    </div>
                                    <hr>
                                @endfor
                            </div>
                            <br>
                        @else
                            <h3>No Data To Show</h3>
                        @endif
                    </div>
                </div>
                <div class="right-side-form d-none">
                    <form action="{{ route('employers.editProfile.addContact') }}" class="mt-3" method="POST">
                        @csrf
                        <div class="contact-info-body">
                            @if (@$employer->contact_persons_information)
                                <?php
                                
                                $infos = json_decode(@$employer->contact_persons_information);
                                $name = @$infos->names ? $infos->names : (@$infos->name ? $infos->name : []);
                                $email = @$infos->emails ? $infos->emails : (@$infos->email ? $infos->email : []);
                                $designation = $infos->designation;
                                $mobile = @$infos->number ? $infos->number : (@$infos->mobile ? $infos->mobile : []);
                                
                                $count = count($name);
                                ?>
                                @for ($i = 0; $i < $count; $i++)
                                    <?php $a = $i; ?>
                                    <div class="contact-info">
                                        <div class="education-heading">
                                            <div class="education-info-title">Contact Person - {{ ++$a }}
                                            </div>
                                            <div class="btn delete-btn">
                                                Delete
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">Name
                                                        <span class="red">*</span></label>
                                                    <input type="text" name="contact_name[]" id="nameInput"
                                                        class="form-control"
                                                        value="{{ old('contact_name') ? old('contact_name') : $name[$i] }}">
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Email<span
                                                            class="red">*</span></label>
                                                    <input type="email" name="contact_email[]" id="emailInput"
                                                        class="form-control"
                                                        value="{{ old('contact_email') ? old('contact_email') : $email[$i] }}">
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="designationInput" class="form-label">Designation <span
                                                            class="red">*</span></label>
                                                    <input type="text" name="contact_designation[]" id="designationInput"
                                                        class="form-control"
                                                        value="{{ old('contact_designation') ? old('contact_designation') : $designation[$i] }}">
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="mobileInput" class="form-label">Mobile Number
                                                        <span class="red">*</span></label>
                                                    <input type="text" name="contact_mobile[]" id="mobileInput"
                                                        class="form-control"
                                                        value="{{ old('contact_mobile') ? old('contact_mobile') : $mobile[$i] }}">
                                                </div>
                                            </div><!--end col-->
                                        </div>
                                        <hr>
                                    </div>
                                @endfor
                            @endif

                        </div>
                        <div class="education-footer-btn">
                            <div class="text-left">
                                <button type="button" id="contact-more" name="submit" class="btn btn-outline-danger">
                                    Add More <span class="icon"><i class="fa-solid fa-plus"></i></span> </button>
                            </div>
                            <div class="text-right">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                    Save Contact </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var $i = {{ isset($infos->names) ? count($infos->names) : 0 }};
        $(".delete-btn").on("click", function() {
            $(this).closest(".contact-info").remove();
            --$i;
        });

        $(".contact-info-body").on("click", ".delete-btn", function() {
            $(this).closest(".contact-info").remove();
        });

        $("#contact-more").click(function() {
            $(".contact-info-body").append(
                '<div class="contact-info"><div class="education-heading"><div class="education-info-title">Contact Person -' +
                ++$i +
                '</div><div class="btn delete-btn">Delete</div></div><div class="row"><div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Name<span class="red">*</span></label><input type="text" name="contact_name[]" id="nameInput" class="form-control" value=""></div></div><!--end col--><div class="col-md-6"><div class="mb-3"><label for="emailInput" class="form-label">Email<span class="red">*</span></label><input type="email" name="contact_email[]" id="emailInput" class="form-control" value=""></div></div><!--end col--><div class="col-md-6"><div class="mb-3"><label for="designationInput" class="form-label">Designation <span class="red">*</span></label><input type="text" name="contact_designation[]" id="designationInput" class="form-control" value=""></div></div><!--end col--><div class="col-md-6"><div class="mb-3"><label for="mobileInput" class="form-label">Mobile Number<span class="red">*</span></label><input type="text" name="contact_mobile[]" id="mobileInput" class="form-control" value=""></div></div><!--end col--></div><hr></div>'
            );
        });
    </script>
@endpush
