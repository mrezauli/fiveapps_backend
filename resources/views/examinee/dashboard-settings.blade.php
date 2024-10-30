@extends('examinee.layout')
@section('content')
    <div class="mb-5 dashboard-heading">
        <h3 class="fs-22 font-weight-semi-bold">Settings</h3>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="list-group list-group-flush">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <ul class="nav nav-tabs generic-tab pb-30px" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="password-tab" data-toggle="tab" href="#password" role="tab"
                aria-controls="password" aria-selected="true">
                Password
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="password" role="tabpanel" aria-labelledby="password-tab">
            <div class="setting-body">
                <h3 class="pb-4 fs-17 font-weight-semi-bold">Change Password</h3>
                <form method="post" class="row" action="{{ route('examinee.settings.change') }}">
                    @csrf
                    <div class="input-box col-lg-4">
                        <label class="label-text">Old Password</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="old_password"
                                placeholder="Old Password" required>
                            <span class="la la-lock input-icon"></span>
                        </div>
                    </div><!-- end input-box -->
                    <div class="input-box col-lg-4">
                        <label class="label-text">New Password</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="new_password"
                                placeholder="New Password" required minlength="8">
                            <span class="la la-lock input-icon"></span>
                        </div>
                    </div><!-- end input-box -->
                    <div class="input-box col-lg-4">
                        <label class="label-text">Confirm New Password</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="new_password_confirmation"
                                placeholder="Confirm New Password" required minlength="8">
                            <span class="la la-lock input-icon"></span>
                        </div>
                    </div><!-- end input-box -->
                    <div class="py-2 input-box col-lg-12">
                        <button class="btn theme-btn">Change Password</button>
                    </div><!-- end input-box -->
                </form>
            </div><!-- end setting-body -->
        </div><!-- end tab-pane -->
    </div><!-- end tab-content -->
@endsection
