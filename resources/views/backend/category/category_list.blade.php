@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title mb-2">Add Category</h4>
                            </div>


                            <form method="POST" action="{{route('add.category')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Category Name</label>
                                            <input name="category_name" type="text" class="form-control"
                                                id="firstname" placeholder="Enter Category Name">
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
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width:20%">ID</th>
                                        <th style="width: 50%">Name</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('update.category', $category->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light update-customerloyee-button">Update</a>
                                            <a href="{{ route('delete.category', $category->id) }}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete1">Delete</a>
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
    
@endsection
