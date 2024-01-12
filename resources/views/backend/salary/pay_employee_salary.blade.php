@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content -->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-5 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="header-title mb-4">Add Advance Salary</h4>
                            </div>

                            <form method="POST" action="{{ route('store.salary') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label for="experience" class="form-label">
                                                <i class="fas fa-user"></i> Employee Name
                                            </label>
                                            <p class="mb-0 employee-name h5">{{ $employee->name }}</p>
                                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label for="date" class="form-label">
                                                <i class="fas fa-calendar"></i> Salary Month
                                            </label>
                                            <p class="mb-0 salary-month h5">{{ date('F', strtotime('-1 month')) }}</p>
                                            <input type="hidden" name="date"
                                                value="{{ date('F', strtotime('-1 month')) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label for="advance" class="form-label">
                                                <i class="fas fa-money-bill"></i> Employee Salary
                                            </label>
                                            <p class="mb-0 employee-salary h5">{{ $employee->salary }} Rs</p>
                                            <input type="hidden" name="total_salary" value="{{ $employee->salary }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label for="advance" class="form-label">
                                                <i class="fas fa-coins"></i> Employee Advance
                                            </label>
                                            <p class="mb-0">
                                                @if ($employee->advance->isNotEmpty())
                                                    @php
                                                        $totalAdvance = 0;
                                                    @endphp
                                                    @foreach ($employee->advance as $advance)
                                                        @php
                                                            if ($advance->status == 0) {
                                                                $totalAdvance += $advance->advance_salary;
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    <strong class="text-primary h5">{{ $totalAdvance }} Rs</strong>
                                                    <input type="hidden" name="advance_salary" value="{{ $totalAdvance }}">
                                                @else
                                                    <input type="hidden" name="advance_salary" value="0">
                                                    <strong style="color:black;" class="h5">0 Rs</strong>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label for="advance" class="form-label">
                                                <i class="fas fa-dollar-sign"></i> Total Salary
                                            </label>
                                            <p class="mb-0">
                                                @if ($employee->advance->isNotEmpty())
                                                    @php
                                                        $salary = $employee->salary;
                                                        $duesalary = $salary - $totalAdvance;
                                                    @endphp
                                                    <strong class="text-success h5">{{ number_format($duesalary, 0) }}
                                                        Rs</strong>
                                                    <input type="hidden" name="paid_amount" value="{{ $duesalary }}">
                                                @else
                                                    <strong style="color:black;"
                                                        class="h5">{{ number_format($employee->salary, 0) }}
                                                        Rs</strong>
                                                    <input type="hidden" name="paid_amount"
                                                        value="{{ $employee->salary }}">
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-4">
                                        <i class="fas fa-save"></i> Pay Salary
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- Add other form fields here -->
                    </div> <!-- end card body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>
    </div> <!-- container -->
    </div> <!-- content -->
@endsection
