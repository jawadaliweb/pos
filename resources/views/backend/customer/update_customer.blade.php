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
<h4 class="header-title mb-2">Add Customer</h4>
</div>

<form method="POST" action="{{ route('updating.customer', $customer->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Customer Name</label>
                <input name="name" type="text" value="{{ $customer->name }}" class="form-control" id="name" placeholder="Enter Name">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">Customer Email</label>
                <input name="email" type="email" value="{{ $customer->email }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="address" class="form-label">Customer Address</label>
                <input name="address" type="text" value="{{ $customer->address }}" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter address">
                @error('address')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="city" class="form-label">Customer City</label>
                <input name="city" type="text" value="{{ $customer->city }}" class="form-control @error('city') is-invalid @enderror" id="city" placeholder="Enter city">
                @error('city')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input name="phone" type="text" value="{{ $customer->phone }}" class="form-control" id="phone" placeholder="Enter phone">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="shopname" class="form-label">Shop Name</label>
                <input name="shopname" type="text" value="{{ $customer->shopname }}" class="form-control" id="shopname" placeholder="Enter shop name">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="account_holder" class="form-label">Account Holder</label>
                <input name="account_holder" type="text" value="{{ $customer->account_holder }}" class="form-control" id="account_holder" placeholder="Enter Account Holder">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="account_number" class="form-label">Account Number</label>
                <input name="account_number" type="text" value="{{ $customer->account_number }}" class="form-control" id="account_number" placeholder="Enter Account Number">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="bank_name" class="form-label">Bank Name</label>
                <input name="bank_name" type="text" value="{{ $customer->bank_name }}" class="form-control" id="bank_name" placeholder="Enter Bank Name">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="bank_branch" class="form-label">Bank Branch</label>
                <input name="bank_branch" type="text" value="{{ $customer->bank_branch }}" class="form-control" id="bank_branch" placeholder="Enter Bank Branch">
            </div>
        </div>

        <div class="col-md-12">
            <div class="mt-3">
                <input name="image" type="file" data-plugins="dropify" />
                <p class="text-muted text-center mt-2 mb-0">Upload Customer Photo</p>
            </div>
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
