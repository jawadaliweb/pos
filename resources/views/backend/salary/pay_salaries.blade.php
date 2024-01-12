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
<h4 class="header-title mb-2">Pay Salary</h4>
{{-- <a href="{{ route('add.advance.salary') }}"
    class="btn btn-primary rounded-pill waves-effect waves-light">Add Advance Salary</a> --}}
</div>
<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
<thead>
    <tr>
        <th>ID</th>
        <th>Employee Image</th>
        <th>Employee Name</th>
        <th>Date</th>
        <th>Salary</th>
        <th>Advance Amount</th>
        <th>Due Amount</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($employees_data as $employee)
    <tr>
        <td>{{ $employee->id }}</td>
        <td><img style="border-radius: 200px;" width="50" src="{{ asset('upload/employee/'.$employee->image) }}" alt=""></td>
        <td>{{ $employee->name }}</td>
        <td> <span class="badge bg-info">{{ date('F', strtotime('-1 month')) }} </span></td>
        <td>{{ $employee->salary }} Rs</td>

        <td>
            @if ($employee->advance)
            @php
                $totalAdvance = 0;
            @endphp
        @foreach ($employee->advance as $advance)
                @php
                if ($advance->status == 0) {
                    $totalAdvance += $advance->advance_salary;
                }
                @endphp
            @endforeach
            {{ $totalAdvance }} Rs
            @else
                0
            @endif
            
        </td>
        <td>
            @if ($employee->advance->isNotEmpty())
                @php
                    $salary = $employee->salary;
                    $due = $salary - $totalAdvance;
                @endphp
             <strong  class="text-black">  {{ round( $due ) }} Rs </strong> 

                
            @else
             <strong  style="color:black;">  {{round($employee->salary)}} Rs </strong> 
            @endif
        </td>
        
        

        <td>
            @if ($paid_salaries_empids->contains($employee->id))
                <a class="btn btn-success rounded-pill waves-effect waves-light update-employee-button" >Paid</a>
            @else
                <a href="{{ route('pay.salary',$employee->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light update-employee-button" >Pay Now</a>
            @endif
        
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
