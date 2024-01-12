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
                                <h4 class="header-title mb-2">Expenses List</h4>

                                

                                <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#con-close-modal">Add Expense</button>
                            </div>
                           
                            <form method="get" action="{{ route('expense.list') }}" class="d-flex">

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="from_date" class="mr-2">From Date:</label>
                                            <input value="{{ $fromDate }}" type="date" id="from_date" name="from_date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="to_date" class="mr-2">To Date:</label>
                                            <input value="{{ $toDate }}" type="date" id="to_date" name="to_date" class="form-control">
                                        </div>
                                    </div>

                                <div class="col-md-3">
                                    <div style="margin-top: 20px;">
                                    <button  style="" type="submit" class="btn btn-success">Apply</button>
                                   
                                    @if($fromDate == now()->startOfMonth())

                                    @else
                                    <a  href="{{route('expense.list')}}" style="margin-left: 10px;" class="btn btn-primary">Reset</a>
                                    @endif
                                    

                                </div>
                                </div>
                                <div>
                                    <h5 class="text-center text-dark" style="width: 15%; padding:5px; border-radius:20px; margin-left:auto; margin-right:auto; border:1px solid rgba(0, 0, 0, 0.211); "> {{ date('F') }} Expenses </h5>
                                </div>

                            </form>
                           
                            
                            <form action="{{ route('delete.multiple.expenses') }}" method="POST" id="delete-expenses-form">
                                @csrf
                                @method('delete')
                                

                                <table style="vertical-align: middle;" id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                  
                                    <thead>
                                        
                                        <tr>
                                            
                                            <th>Select</th>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Reciepts</th>
                                            <th style="text-align: center; width:14%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($expenses as $expense)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" value="{{$expense->id}}" name="delete[]">
                                                </td>
                                                <td>{{ $expense->id }}</td>
                                                <td>{{ $expense->title }}</td>
                                                <td>{{ $expense->amount }}</td>
                                                <td>{{ $expense->description }}</td>
                                                <td>{{ $expense->date }}</td>
                                                <td>
                                                    <a href="{{ asset('upload/expenses/'. $expense->receipt) }}" data-lightbox="receipts" data-title="{{ $expense->title }}">
                                                        <img width="50" src="{{ asset('upload/expenses/'. $expense->receipt) }}" alt="">
                                                    </a>
                                                </td>
                                                
                                                
                                                <td style="padding: 25px 0px"  class="d-flex justify-content-around">
                                                    <a data-bs-toggle="modal" data-bs-target="#update-expense-modal-{{ $expense->id }}" class="btn btn-blue rounded-pill waves-effect waves-light update-expense-button">Update</a>
                                                    <a href="{{ route('delete.expense', $expense->id) }}"
                                                        class="btn btn-danger rounded-pill waves-effect waves-light"
                                                        id="delete1">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if ($expenses->isNotEmpty())
                                <button type="button" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete-selected-button">Delete Selected</button>
                            @endif
                            
                            </form>
                        </div> <!-- end card -->
                    </div><!-- end col-->
                    

                    {{-- Expense adding modal poup --}}
                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" >
                            <div class="modal-content">
                                <form method="POST" action="{{ route('add.expense') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Expense</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Expense Title</label>
                                                    <input name="title" type="text" class="form-control"
                                                        id="field-1" placeholder="Enter title">
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Expense amount</label>
                                                    <input name="amount" type="number" class="form-control"
                                                        id="field-1" placeholder="Enter description">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                <label for="datepicker">Select Date:</label>
                                                <input name="date" type="date" id="datepicker" class="form-control">
                                            </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Expense description</label>
                                                    <textarea name="description" class="form-control" id="field-1" placeholder="Enter description" style="height: 100px;"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="mt-3">
                                                    <input name="receipt" type="file" data-plugins="dropify" />
                                                    <p class="text-muted text-center mt-2 mb-0">Upload receipt</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->



                    
                    {{-- Expense Updating modal poup --}}
                    @foreach ($expenses as $expense)
                    <div id="update-expense-modal-{{ $expense->id }}" class="modal fade" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" >
                            <div class="modal-content">
                                <form method="POST" action="{{ route('update.expense',$expense->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h4 class="modal-title">Update Expense</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Expense Title</label>
                                                    <input value="{{$expense->title}}" name="title" type="text" class="form-control"
                                                        id="field-1" placeholder="Enter title">
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Expense amount</label>
                                                    <input  value="{{$expense->amount}}" name="amount" type="number" class="form-control"
                                                        id="field-1" placeholder="Enter description">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                <label for="datepicker">Select Date:</label>
                                                <input value="{{$expense->date}}" name="date" type="date" id="datepicker" class="form-control">
                                            </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Expense description</label>
                                                    <textarea  name="description" class="form-control" id="field-1" placeholder="Enter description" style="height: 100px;">{{$expense->description}}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="mt-3">
                                                    <input value="{{$expense->receipt}}" name="receipt" type="file" data-plugins="dropify" />
                                                    <p class="text-muted text-center mt-2 mb-0">Upload receipt</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                    @endforeach

                </div>
            </div> <!-- container -->
        </div> <!-- content -->

        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            });
        </script>
        
        
    @endsection
