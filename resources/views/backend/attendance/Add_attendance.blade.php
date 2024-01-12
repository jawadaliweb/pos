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
<h4 class="header-title mb-2">Add Attendance</h4>
</div>

<form method="POST" action="{{route('attendance.store')}}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <select name="employee_id" class="form-select" aria-label="Default select example">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <input name="date" type="datetime-local" name="selected_date" class="form-control" required>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
    </div>
</form>


</div> <!-- end card body-->
</div> <!-- end card -->
</div><!-- end col-->
</div>
</div> <!-- container -->
</div> <!-- content -->
@endsection
