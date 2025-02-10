<?php
if (!is_null(auth()->user()->job_seeker)) {
    $profile_pic = auth()->user()->job_seeker->profile_pic;
    if (!is_null($profile_pic)) {
        $url = asset('/storage/job-seeker/' . $profile_pic);
    } else {
        $url = asset('frontend/assets/images/files/spy.png');
    }
} else {
    $url = asset('frontend/assets/images/files/spy.png');
}
?>
<ul class="header-menu list-inline d-flex align-items-center mb-0">
    <li class="list-inline-item dropdown">
        <a href="javascript:void(0)" class="header-item" id="userdropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ $url }}" alt="mdo" width="35" height="35" class="rounded-circle me-1">
            <span class="fw-medium">
                {{ auth()->user()->username }} <span class="top-icon">
                    <i class="fa-solid fa-angle-down"></i>
                </span>
            </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
            <li><a class="dropdown-item" href="{{ route('user.dashboard', auth()->user()->username) }}">Overview</a>
            </li>
            <li><a class="dropdown-item" href="{{ route('user.profile', auth()->user()->username) }}">My Profile</a>
            </li>
            <li><a class="dropdown-item" href="{{ route('user.profileStatus', auth()->user()->username) }}">My
                    Status</a></li>
            <li><a class="dropdown-item" href="{{ route('user.setting', auth()->user()->username) }}">Settings</a></li>
            <form action="{{ route('logout') }}" method="POST" id="logout">
                @csrf
            </form>
            <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
        </ul>
    </li>
</ul>
