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
<h4 class="header-title mb-2">customer Records</h4>
<a href="{{ route('customer_add_form') }}"
    class="btn btn-primary rounded-pill waves-effect waves-light">Add customer</a>
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
    @foreach ($customer_data as $customer)
    <tr>
        <td>{{ $customer->id }}</td>
        <td>{{ $customer->name }}</td>
        <td>{{ $customer->email }}</td>
        <td>{{ $customer->phone }}</td>
        <td>{{ $customer->address }}</td>
        <td>{{ $customer->shopname }}</td>
        <td>{{ $customer->city }}</td>
        <td>{{ $customer->bank_name }}</td>
        <td><img style="border-radius: 200px;" width="50" src="{{ asset('upload/customer/'.$customer->image) }}" alt=""></td>

        <td  class="d-flex">
        <a href="{{ route('update.customer',$customer->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light update-customerloyee-button" >Update</a>
        <a href="{{ route('delete.customer',$customer->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete1">Delete</a>
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
