@extends('employer.account-settings.layouts.app')
@section('title', 'Deactivate Account')
@section('dashboard-content')
    <div class="tab-main-title">
        <span class="tab-icon">
            <i class="fa-solid fa-circle-user"></i>
        </span> &nbsp;
        Deactivate Account
    </div>
    <!-- <h5> Deactivating your MegaJob Account</h5> -->

    <div class="tab-main-content social-card">
        <form method="post" action="{{ route('employers.settings.deactivate-account') }}" class="contact-form mt-4"
            name="myForm" id="deactivationForm">
            @csrf
            <span id="error-msg"></span>
            @if (!auth()->user()->is_deactivated)
                <label for="permanent" class="flex-label">
                    <div class="message">
                        <span>Deactivating your account is temporary.</span>
                        Your
                        account and main profile will be deactivated and your
                        name
                        and photos will be removed from most things you've
                        shared.
                    </div>
                    <input type="radio" id="permanent" name="action" value="deactivate">

                </label>
                <label for="temporary" class="flex-label">
                    <div class="message">
                        <span>Deleting your account is permanent.</span> When
                        you delete your
                        megajob account, you won't be able to retrieve the
                        content
                        or information you've shared on megajob. Your main
                        profile and all of your messages will also be deleted.
                    </div>
                    <input type="radio" id="temporary" name="action" value="delete">
                </label>
            @else
                <label for="permanent" class="flex-label">
                    <div class="message">
                        <span>Activate your account.</span>
                        You'll be visible on {{ env('APP_NAME') }} and can post more jobs.
                    </div>
                    <input type="radio" id="permanent" name="action" value="activate">

                </label>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Password Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label>Enter your password for confirmation:</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Your Password" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="" class="btn btn-primary mx-2">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <hr>
    <div class="tab-main-footer">
        <button type="button" class="btn btn-primary btn-hover" onclick="deactivate()">Continue </button>
        <a href="{{ route('employers.settings.accountSettings') }}" class="btn btn-orange btn-hover">Cancel </a>
    </div>

@endsection
@push('script')
    <script>
        function deactivate() {
            swal({
                title: "Are you sure?",
                text: "You will be deactivating your account",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $('#passwordModal').modal('show');

                }
            });
        }
    </script>
@endpush
@section('modal')

@endsection
