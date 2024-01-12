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
<h4 class="header-title mb-2">Add supplier</h4>
</div>

<form method="POST" action="{{ route('supplier.adding') }}" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label for="name" class="form-label">supplier Name</label>
<input name="name" type="text" value="" class="form-control"
id="name" placeholder="Enter Name">
</div>
</div>

<div class="col-md-6">
<div class="mb-3">
<label for="email" class="form-label">supplier Email</label>
<input name="email" type="email" value=""
class="form-control @error('email')
is-invalid    @enderror
" id="email"
placeholder="Enter email">
@error('email')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
</div>

<div class="col-md-6">
    <div class="mb-3">
    <label for="address" class="form-label">supplier Address</label>
    <input name="address" type="text" value=""
    class="form-control @error('address')
    is-invalid    @enderror
    " id="address"
    placeholder="Enter address">
    @error('address')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>
    </div>



    <div class="col-md-6">
    <div class="mb-3">
    <label for="city" class="form-label">supplier City</label>
    <input name="city" type="text" value=""
    class="form-control @error('city')
    is-invalid    @enderror
    " id="city"
    placeholder="Enter city">
    @error('city')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>
    </div>


<div class="col-md-6">
<div class="mb-3">
<label for="phone" class="form-label">Phone</label>
<input name="phone" type="text" value="" class="form-control"
    id="phone" placeholder="Enter phone">
</div>
</div>

<div class="col-md-6">
    <div class="mb-3">
    <label for="Type" class="form-label">Supplier Type</label>

    <select  name="type" class="form-select" aria-label="Default select example">
        <option selected value="Whole Sale">Whole Sale</option>
        <option value="Distributor">Distributor</option>
      </select>
    </div>
    </div>

<div class="col-md-6">
    <div class="mb-3">
    <label for="shopname" class="form-label">shop name</label>
    <input name="shopname" type="text" value="" class="form-control"
        id="shopname" placeholder="Enter shop name">
    </div>
    </div>

    <div class="col-md-6">
    <div class="mb-3">
    <label for="account holder" class="form-label">Account Holder</label>
    <input name="account_holder" type="text" value="" class="form-control"
        id="accountholder" placeholder="Enter Account holder">
    </div>
    </div>


    <div class="col-md-6">
        <div class="mb-3">
        <label for="account number" class="form-label">Account Number</label>
        <input name="account_number" type="text" value="" class="form-control"
            id="accountnumber" placeholder="Enter Account number">
        </div>
        </div>

    <div class="col-md-6">
        <div class="mb-3">
        <label for="bank name" class="form-label">Bank Name</label>
        <input name="bank_name" type="text" value="" class="form-control"
            id="bankname" placeholder="Enter Bank Name">
        </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
            <label for="bank branch" class="form-label">Bank Branch</label>
            <input name="bank_branch" type="text" value="" class="form-control"
                id="branch" placeholder="Enter Bank branch">
            </div>
            </div>


<div class="col-md-12">
<div class="mt-3">
<input name="image" type="file" data-plugins="dropify" />
<p class="text-muted text-center mt-2 mb-0">Upload supplier Photo</p>
</div>
</div>


</div>

<div class="text-end">
<button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
class="mdi mdi-content-save"></i> Save</button>
</div>

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
