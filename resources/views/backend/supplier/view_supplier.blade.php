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
<h4 class="header-title mb-2">supplier Records</h4>
<a href="{{ route('supplier_add_form') }}"
    class="btn btn-primary rounded-pill waves-effect waves-light">Add supplier</a>
</div>
<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>address</th>
        <th>shopname</th>
        <th>City</th>
        <th>Bank Name</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($Suppdata as $supplier)
    <tr>
        <td>{{ $supplier->id }}</td>
        <td>{{ $supplier->name }}</td>
        <td>{{ $supplier->email }}</td>
        <td>{{ $supplier->phone }}</td>
        <td>{{ $supplier->address }}</td>
        <td>{{ $supplier->shopname }}</td>
        <td>{{ $supplier->city }}</td>
        <td>{{ $supplier->bank_name }}</td>
        <td><img style="border-radius: 200px;" width="50" src="{{ asset('upload/supplier/'.$supplier->image) }}" alt=""></td>

        <td  class="d-flex">
            <a href="{{ route('update.supplier',$supplier->id) }}" class="mt-2 mb-2 m-1 btn btn-blue rounded-pill waves-effect waves-light update-supplierloyee-button" >Update</a>
            <a href="{{ route('delete.supplier',$supplier->id) }}" class="mt-2 mb-2 btn btn-danger rounded-pill waves-effect waves-light" id="delete1">Delete</a>
            <a href="{{ route('details.supplier',$supplier->id) }}" class="mt-2 mb-2 m-1 btn btn-success rounded-pill waves-effect waves-light" >Details</a>
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
