@extends('admin_dashboard')
@section('admin')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">Change Password</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.password.update') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="old_password" class="form-label">Old Password</label>
                                        <input name="oldpassword" type="password" class="form-control" id="old_password" placeholder="Old Password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input name="newpassword" type="password" class="form-control" id="new_password" placeholder="New Password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input name="confirmpassword" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>

                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                @php
                                    $errorWithCustomNames = str_replace(['oldpassword', 'newpassword', 'confirmpassword'], ['Current Password', 'New Password', 'Confirm Password'], $error);
                                    toastr()->error($errorWithCustomNames);
                                @endphp
                            @endforeach
                            @endif

                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                            </div>
                        </form>

                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->
@endsection
