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
<h4 class="header-title mb-2">Employees Records</h4>
<a href="{{ route('employee.add') }}"
    class="btn btn-primary rounded-pill waves-effect waves-light">Add Employee</a>
</div>
<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Salary</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($EmpData as $emp)
    <tr>
        <td>{{ $emp->id }}</td>
        <td>{{ $emp->name }}</td>
        <td>{{ $emp->email }}</td>
        <td>{{ $emp->phone }}</td>
        <td>{{ $emp->salary }}</td>
        <td><img style="border-radius: 200px;" width="50" src="{{ asset('upload/employee/'.$emp->image) }}" alt=""></td>
        <td  class="d-flex">

        <a href="{{ route('update.employee',$emp->id) }}" class="m-1  btn btn-blue rounded-pill waves-effect waves-light update-employee-button" >
            Update
        </a>


        <a href="{{ route('delete.employee',$emp->id) }}" class="m-1  btn btn-danger rounded-pill waves-effect waves-light" id="delete1">Delete</a>

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
