@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                {{-- <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Supplier Name</th>
                                        <th>Category</th>
                                        <th >Quantity</th>
                                        <th >Price</th>
                                        <th >Discount</th>
                                        <th>Total price</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stocks as $key => $stock)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $stock->product->product_name }}</td>
                                        <td>{{ $stock->purchase->supplier->name }}</td>
                                        <td> {{ $stock->product->category->category_name }}</td>
                                        <td>{{ $stock->quantity }} PCs</td>
                                        <td>{{ $stock->price }} Rs</td>
                                        <td>{{ $stock->discount }} Rs</td>
                                        <td> <strong>{{ $stock->total_price }} Rs </strong></td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('update.category', $stock->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light update-customerloyee-button">Update</a>
                                            <a href="{{ route('delete.category', $stock->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete1">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody> --}}
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Supplier</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Total Quantity</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->supplier->name }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->total_price }}</td>
                                            <td>{{ $item->total_quantity }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchase_stocks_{{$item->id}}">
                                                <i class="bi bi-eye"></i>
                                                </button>
                                                <a href="{{ route('delete.purchase', $item->id) }}" id="delete1" class="btn btn-danger  waves-effect waves-light update-customerloyee-button"><i class="bi bi-trash"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card -->
                    </div><!-- end col-->



                </div>
            </div> <!-- container -->
        </div> <!-- content -->


        {{-- ---------------------- Modals ---------------------- --}}
        @foreach ($purchases as $purchase)
            <div class="modal fade" id="purchase_stocks_{{$purchase->id}}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Purchase Stocks</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Total Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchase->stocks as $key=> $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->product->product_name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->discount}}</td>
                                            <td>{{$item->total_price}}</td>
                                            <td>
                                            <a href="{{ route('delete.stock', $item->id) }}" id="delete1" class="btn btn-danger  waves-effect waves-light update-customerloyee-button"><i class="bi bi-trash"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- ---------------------- Modals ---------------------- --}}
    @endsection
