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
<h4 class="header-title mb-2">All Permissions</h4>
<a href="{{ route('add.permissions') }}"
    class="btn btn-primary rounded-pill waves-effect waves-light">Add Permission</a>
</div>
<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
<thead>
    <tr>

        <th>ID</th>
        <th>Permission Name</th>
        <th>Group Name</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($permissions as $key=> $permission)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $permission->name }}</td>
        <td>{{ $permission->group_name }}</td>
        <td  class="d-flex">
        <a href="{{ route('permission.update',$permission->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light update-customerloyee-button" >Update</a>
        <a href="{{ route('permission.delete',$permission->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete1">Delete</a>
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
