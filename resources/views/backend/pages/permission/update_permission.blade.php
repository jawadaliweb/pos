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
<h4 class="header-title mb-2">Update Permission</h4>
</div>

<form method="POST" action="{{ route('permission.edit', $permission->id) }}" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input name="name" type="text" value="{{$permission->name}}" class="form-control" id="name" placeholder="Enter Name">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Select Group</label>

            <select name="group_name" class="form-select" aria-label="Default select example">
                <option selected disabled value="Select Group">Select Group</option>
                <option value="pos" {{$permission->group_name == 'pos' ?  'selected' : ''}}>Pos</option>
                <option value="employee" {{$permission->group_name == 'employee' ?  'selected' : ''}}>Employee</option>
                <option value="customer"{{$permission->group_name == 'customer' ?  'selected' : ''}} >Customer</option>
                <option value="supplier"{{$permission->group_name == 'supplier' ?  'selected' : ''}} >Supplier</option>
                <option value="salary"{{$permission->group_name == 'salary' ?  'selected' : ''}} >Salary</option>
                <option value="attendence"{{$permission->group_name == 'attendence' ?  'selected' : ''}} >Attendence</option>
                <option value="category"{{$permission->group_name == 'category' ?  'selected' : ''}} >Category</option>
                <option value="product"{{$permission->group_name == 'product' ?  'selected' : ''}} >Product</option>
                <option value="expense"{{$permission->group_name == 'expense' ?  'selected' : ''}} >Expense</option>
                <option value="orders"{{$permission->group_name == 'orders' ?  'selected' : ''}} >Orders</option>
                <option value="stock"{{$permission->group_name == 'stock' ?  'selected' : ''}} >Stock</option>
                <option value="roles"{{$permission->group_name == 'roles' ?  'selected' : ''}} >Roles</option>
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
