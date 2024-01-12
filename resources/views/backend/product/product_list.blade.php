@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title mb-2">Products List</h4>
                                <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#con-close-modal">Add Product</button>
                            </div>
                            <table style="vertical-align: middle;" id="datatable-buttons"
                                class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Product Code</th>
                                        <th>Sale Price</th>
                                        <th>Total Stocks</th>
                                        <th>Category</th>
                                        <th style="text-align: center; width:14%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                <img width="50"
                                                    src="{{ asset('upload/product/' . $product->product_image) }}"
                                                    alt="">
                                            </td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->sale_price }}</td>
                                            <td>
                                                {{ $product->quantity }}
                                            </td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td style="padding: 25px 0px" class=" d-flex justify-content-around">
                                                <a href="{{ route('update.product', $product->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light update-customerloyee-button">Update</a>
                                                <a href="{{ route('delete.product', $product->id) }}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light"
                                                    id="delete1">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card -->
                    </div><!-- end col-->

                    {{-- product adding modal poup --}}
                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('add.product') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Product</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="field-1" class="form-label">Proudct Name</label>
                                                    <input name="product_name" type="text" class="form-control"
                                                        id="field-1" placeholder="Enter Name">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="field-1" class="form-label">Proudct code</label>
                                                    <input name="product_code" type="text" class="form-control"
                                                        id="field-1" placeholder="Enter code">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="field-1" class="form-label">Sale Price</label>
                                                    <input name="sale_price" type="text" class="form-control"
                                                        id="field-1" placeholder="Sale Price">
                                                </div>
                                            </div>

                                            <div class="col-md-12   ">
                                                <div class="mb-3">
                                                    <label for="field-1" class="form-label">Select Category</label>
                                                    <select name="category_id" class="form-select"
                                                        aria-label="Default select example">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" selected>
                                                                {{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mt-3">
                                                    <input name="product_image" type="file" data-plugins="dropify" />
                                                    <p class="text-muted text-center mt-2 mb-0">Upload Product Photo</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->


                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    @endsection
