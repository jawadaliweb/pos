@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title mb-2">Add Employees</h4>
                            </div>

                            <form method="POST" action="{{ route('updating.employee',$employee->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{-- <input type="hidden" name="id" value="{{ $employee->id }}"> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Employee Name</label>
                                            <input name="name" value="{{ $employee->name }}" type="text"
                                                value="" class="form-control" id="firstname" placeholder="Enter Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Employee Email</label>
                                            <input value="{{ $employee->email }}" name="email" type="email"
                                                value="" class="form-control @error('email')
is-invalid    @enderror
"
                                                id="email" placeholder="Enter email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Employee Address</label>

                                            <input value="{{ $employee->address }}" name="address" type="text"
                                                value=""
                                                class="form-control @error('address')
    is-invalid    @enderror
    "
                                                id="address" placeholder="Enter address">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="experience" class="form-label">Employee Experience</label>

                                            <select name="experience" class="form-select"
                                                aria-label="Default select example">
                                                <option value="1" {{ $employee->experience == '1' ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="2" {{ $employee->experience == '2' ? 'selected' : '' }}>
                                                    2</option>
                                                <option value="3" {{ $employee->experience == '3' ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="4"
                                                    {{ $employee->experience == '4' ? 'selected' : '' }}>4</option>
                                                <option value="5"
                                                    {{ $employee->experience == '5' ? 'selected' : '' }}>5</option>
                                                <option value="6"
                                                    {{ $employee->experience == '6' ? 'selected' : '' }}>6</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="holiday" class="form-label">Employee Vacation</label>
                                            <input value="{{ $employee->holidays }}" name="holidays" type="holiday"
                                                value=""
                                                class="form-control @error('holiday')
    is-invalid    @enderror
    "
                                                id="holiday" placeholder="Enter Vacation">
                                            @error('holiday')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">Employee City</label>
                                            <input value="{{ $employee->city }}" name="city" type="text"
                                                value=""
                                                class="form-control @error('city')
    is-invalid    @enderror
    "
                                                id="city" placeholder="Enter city">
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input value="{{ $employee->phone }}" name="phone" type="text"
                                                value="" class="form-control" id="phone"
                                                placeholder="Enter phone">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="salary" class="form-label">Salary</label>
                                            <input value="{{ $employee->salary }}" name="salary" type="text"
                                                value="" class="form-control" id="salary"
                                                placeholder="Enter salary">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mt-3">
                                            <input value="" name="image" type="file"
                                                data-plugins="dropify" />
                                            <p class="text-muted text-center mt-2 mb-0">Upload Employee Photo</p>
                                        </div>
                                    </div>


                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Save</button>
                                </div>

                        </div>
                        <!-- Add other form fields here -->

                        </form>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div> <!-- container -->
    </div> <!-- content -->
@endsection
