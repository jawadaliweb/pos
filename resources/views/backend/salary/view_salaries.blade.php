@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title mb-2">Advance Salary Records</h4>
                                <a href="{{ route('add.advance.salary') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Add Advance Salary</a>
                            </div>
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employee Image</th>
                                        <th>Employee Name</th>
                                        <th>Salary</th>
                                        <th>Advance Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($AdvanceSalaries as $AdvanceSalary)
                                        <tr>
                                            <td>{{ $AdvanceSalary->id }}</td>
                                            <td><img style="border-radius: 200px;" width="50"
                                                    src="{{ asset('upload/employee/' . $AdvanceSalary->employee->image) }}"
                                                    alt=""></td>
                                            <td>{{ $AdvanceSalary->employee->name }}</td>
                                            <td>{{ $AdvanceSalary->employee->salary }}</td>
                                            <td>{{ $AdvanceSalary->advance_salary }}</td>
                                            <td>{{ $AdvanceSalary->date }}</td>
                                            <td class="d-flex">


                                                @if ($AdvanceSalary->status == 0) 
                                                    <a href="{{ route('update.advance', $AdvanceSalary->id) }}"
                                                        class="m-1  btn btn-blue rounded-pill waves-effect waves-light update-employee-button">
                                                        Update
                                                    </a>
                                                    <a href="{{ route('delete.advance', $AdvanceSalary->id) }}"
                                                        class="m-1  btn btn-danger rounded-pill waves-effect waves-light"
                                                        id="delete1">Delete</a>
                                                @else 
                                                    <a class="m-1  btn btn-success rounded-pill waves-effect waves-light">Paid</a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
