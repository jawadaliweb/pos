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
<h4 class="header-title mb-2">Paid Salary</h4>
{{-- <a href="{{ route('add.advance.salary') }}"
    class="btn btn-primary rounded-pill waves-effect waves-light">Add Advance Salary</a> --}}
</div>
<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
<thead>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Employee Name</th>
        <th>Date</th>
        <th>Advance Salary</th>
        <th>Paid Salary</th>
        <th>Total Salary</th>
        <th>Status</th>
    </tr>
</thead>
<tbody>
    @foreach ($paidsalary as $salary)
    <tr>
        <td>{{ $salary->id }}</td>
        <td><img style="border-radius: 200px;" width="50" src="{{ asset('upload/employee/'.$salary->employee->image) }}" alt=""></td>

        <td>{{ $salary->employee->name }}</td>
        <td> <span class="badge bg-info">{{ $salary->date }} </span></td>
        <td>{{ $salary->advance_salary }} Rs</td>
        <td>{{ $salary->paid_amount }} Rs</td>
        <td>{{ $salary->total_salary }} Rs</td>

        <td>
        <a class="btn btn-success rounded-pill waves-effect waves-light update-employee-button" >Full Paid</a>
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
