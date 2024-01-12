@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title mb-2">Add Users</h4>
                            </div>


                            <form method="POST" action="{{route('update.user', $user->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label"> Name</label>
                                            <input value="{{$user->name}}" name="name" type="text" class="form-control" id="firstname"
                                                placeholder="Enter Name">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label"> email</label>
                                            <input value="{{$user->email}}" name="email" type="email" class="form-control" id="email"
                                                placeholder="Enter Email">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label"> phone</label>
                                            <input value="{{$user->phone}}" name="phone" type="phone" class="form-control" id="phone"
                                                placeholder="Enter phone">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="Role" class="form-label"> Role</label>
                                            <select class="form-select" name="role" aria-label="Default select example">
                                                <option disabled>Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input name="password" class="form-control" type="password">
                                            <div style="position: absolute; left: 93%; top:22%;" class="input-group-addon">
                                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 ">
                                        <label>confrim password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input name="password_confirmation" class="form-control" type="password">
                                            <div style="position: absolute; left: 93%; top:22%;" class="input-group-addon">
                                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Save</button>
                                </div>

                            </form>
                        </div>
                        <!-- Add other form fields here -->


                    </div> <!-- end card body-->
                </div> <!-- end card -->
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width:10%">ID</th>
                                        <th style="width: 20%">Name</th>
                                        <th style="width: 20%">email</th>
                                        <th style="width: 20%">role</th>
                                        <th style="width: 20%">phone</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                 <span class="badge bg-primary">   {{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                                
                                            <td>{{ $user->phone }}</td>

                                            <td class="d-flex justify-content-around">
                                                <a href="{{ route('edit.user', $user->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light update-customerloyee-button">Update</a>
                                                <a href="{{ route('delete.user', $user->id) }}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light"
                                                    id="delete1">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card -->
                    </div><!-- end col-->



                </div>
            </div> <!-- container -->
        </div> <!-- content -->


        <script>
            $(document).ready(function() {
                $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass("fa-eye-slash");
                        $('#show_hide_password i').removeClass("fa-eye");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass("fa-eye-slash");
                        $('#show_hide_password i').addClass("fa-eye");
                    }
                });
            });
        </script>
    @endsection
