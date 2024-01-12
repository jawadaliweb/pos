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
<h4 class="header-title mb-2">Add Permission</h4>
</div>

<form method="POST" action="{{ route('permission.store') }}" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input name="name" type="text" value="" class="form-control" id="name" placeholder="Enter Name">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Select Group</label>

            <select name="group_name" class="form-select" aria-label="Default select example">
                <option selected disabled value="Select Group">Select Group</option>
                <option value="pos">Pos</option>
                <option value="employee">Employee</option>
                <option value="customer">Customer</option>
                <option value="supplier">Supplier</option>
                <option value="salary">Salary</option>
                <option value="attendence">Attendence</option>
                <option value="category">Category</option>
                <option value="product">Product</option>
                <option value="expense">Expense</option>
                <option value="orders">Orders</option>
                <option value="stock">Stock</option>
                <option value="roles">Roles</option>
            </select>
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
</div>
</div> <!-- container -->
</div> <!-- content -->
@endsection
