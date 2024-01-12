@extends('admin_dashboard')
@section('admin')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ $AdminData->photo ? asset('upload/' . $AdminData->photo) : asset('upload/noimage.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">


                        <h4 class="mb-0">{{ $AdminData->name }}</h4>
                        <p class="text-muted">{{ $AdminData->username }}</p>
                        <div class="text-start mt-3">

                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">{{ $AdminData->name }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">{{ $AdminData->phone }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2">{{ $AdminData->email }}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ms-2">USA</span></p>
                        </div>
                    </div>
                </div> <!-- end card -->

            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf

                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label"> Name</label>
                                        <input name="name" type="text" value="{{ $AdminData->name }}" class="form-control" id="firstname" placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Email</label>
                                        <input name="email" type="email" value="{{ $AdminData->email }}" class="form-control" id="lastname" placeholder="Enter Email">
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label"> Name</label>
                                        <input name="phone" type="text" value="{{ $AdminData->phone }}" class="form-control" id="firstname" placeholder="Enter name">
                                    </div>
                                </div>
                                                           </div> <!-- end row -->
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Select Image</label>
                                <input name="photo" class="form-control form-control-sm" id="formFileSm" type="file">
                              </div>

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
