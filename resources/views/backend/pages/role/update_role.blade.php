@extends('admin_dashboard')
@section('admin')
<div class="content">
<!-- Start Content-->
<div class="container-fluid">
<div class="row mt-4">
<div class="col-5">
<div class="card">
<div class="card-body">
<div class="d-flex justify-content-between align-items-center mb-2">
<h4 class="header-title mb-2">Update Permission</h4>
</div>

<form method="POST" action="{{ route('roles.edit', $role->id) }}" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-md-5">
        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input name="name" type="text" value="{{$role->name}}" class="form-control" id="name" placeholder="Enter Name">
        </div>
    </div>

</div>


<div class="text-end">
    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
    class="mdi mdi-content-save"></i> Save</button>
    </div>

<!-- Add other form fields here -->

</form>

</div> <!-- end card body-->
</div> <!-- end card -->
</div><!-- end col-->

<div class="col-7">
    <div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="header-title mb-2">All Roles</h4>
    
    </div>
    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
    <thead>
        <tr>
    
            <th>ID</th>
            <th>Permission Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $key=> $role)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $role->name }}</td>
       
            <td  class="d-flex">
            <a href="{{ route('roles.update',$role->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light update-customerloyee-button" >Update</a>
            <a href="{{ route('roles.delete',$role->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete1">Delete</a>
            </td>
    
        </tr>
        @endforeach
    </tbody>
    </table>
    </div> <!-- end card body-->
    </div> <!-- end card -->
    </div><!-- end col-->


</div>

</div>
</div> <!-- container -->
</div> <!-- content -->
@endsection
