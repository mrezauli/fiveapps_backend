@extends('examinee.layout')
@section('content')
    <div class="mb-5 dashboard-heading">
        <h3 class="fs-22 font-weight-semi-bold">My Profile</h3>
    </div>
    <div class="mb-5 profile-detail">
        <ul class="generic-list-item generic-list-item-flash">
            <li><span class="profile-name">Registration Date:</span><span
                    class="profile-desc">{{ auth()->user()->created_at }}</span></li>
            <li><span class="profile-name">Name:</span><span class="profile-desc">{{ auth()->user()->name }}</span>
            </li>
            <li><span class="profile-name">Email:</span><span class="profile-desc">{{ auth()->user()->email }}</span></li>
            <li><span class="profile-name">Phone Number:</span><span class="profile-desc">{{ auth()->user()->phone }}</span></li>
        </ul>
    </div>
@endsection
