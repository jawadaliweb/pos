@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">

                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title mb-2">Products List</h4>
                                <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#con-close-modal">
                                    < Back</button>
                            </div>

                            <form method="POST" action="{{ route('updating.product', $product->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body p-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="field-1" class="form-label">Proudct Name</label>
                                                <input value="{{ $product->product_name }}" name="product_name"
                                                    type="text" class="form-control" id="field-1"
                                                    placeholder="Enter Name">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="field-1" class="form-label">Proudct code</label>
                                                <input value="{{ $product->product_code }}" name="product_code"
                                                    type="text" class="form-control" id="field-1"
                                                    placeholder="Enter code">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="field-1" class="form-label">Sale Price</label>
                                                <input value="{{ $product->sale_price }}" name="sale_price" type="text"
                                                    class="form-control" id="field-1" placeholder="Sale Price">
                                            </div>
                                        </div>

                                        <div class="col-md-12   ">
                                            <div class="mb-3">
                                                <label for="field-1" class="form-label">Select Category</label>
                                                <select name="category_id" class="form-select"
                                                    aria-label="Default select example">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mt-3">
                                                <input value="{{ asset('upload/product/' . $product->product_image) }}"
                                                    name="product_image" type="file" data-plugins="dropify" />
                                                <p class="text-muted text-center mt-2 mb-0">Upload Product Photo</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Save</button>
                                </div>
                            </form>



                        </div>
                        <!-- Add other form fields here -->

                        </form>
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
