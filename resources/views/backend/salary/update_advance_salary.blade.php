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
                                <h4 class="header-title mb-2">Add Advance Salary</h4>
                            </div>

                            <form method="POST" action="{{ route('updating.Advance', $AdvanceSalary->id) }}">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="experience" class="form-label">Employee Name</label>

                                            <select name="employee_id" class="form-select"
                                                aria-label="Default select example">
                                                    <option value="{{ $AdvanceSalary->employee->name }}">{{ $AdvanceSalary->employee->name }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Month</label>
                                            <input value="{{$AdvanceSalary->date}}" type="month" name="date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="advance" class="form-label">Amount</label>
                                            <input name="advance_salary" type="text" value="{{$AdvanceSalary->advance_salary}}" class="form-control"
                                                id="advance" placeholder="Enter Amount">
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
