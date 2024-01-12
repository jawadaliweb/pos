@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <style>
            .filter-form {
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter-form label {
    font-weight: bold;
}

.filter-form input[type="month"] {
    padding: 5px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
 
.filter-form button {
    padding: 5px 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.filter-form button:hover {
    background-color: #0056b3;
}

        </style>
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title mb-2">Employees Attendance Records</h4>
                                <form method="get" action="{{ route('attendance.list') }}" class="filter-form">
                                    <label for="month">Select Month and Year:</label>
                                    <input type="month" name="date" id="date" value="{{ old('date', date('Y-m')) }}" min="1900-01" max="2099-12">
                                    <button type="submit">Apply Filter</button>
                                </form>
                                
                                <a  class="btn btn-primary rounded-pill waves-effect waves-light" href="{{route('attendanceadd')}}">Add Attendance</a>
                                
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-12">
                                    <div >
 
                                        <table id="datatable-buttons" class="table table-bordered">
                                            <thead >
                                                <tr>
                                                    <th class=" mt-2" style="width: 2px; padding: 4px 13px;">ID</th>
                                                    <th class=" mt-2" style="width: auto; padding: 4px 13px;">Employees</th>
                                                    @foreach ($range as $day)
                                                        <th style="padding: 2px!important; vertical-align: middle; text-align: center">{{$day}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $employee)
                                                    <tr>
                                                        <td style="padding: 4px 13px;">{{ $employee->id }}</td>
                                                        <td style="padding: 4px 13px;">{{  $employee->name}}</td>
                                                        @foreach ($range as $day)
                                                        <td style="padding: 2px!important; vertical-align: middle; text-align: center">
                                                            @php
                                                            $status = '';
                                                            $key = $day . '_' . $employee->id;
                                                            if (isset($new[$key])) {
                                                                $arrivalTime = Carbon\Carbon::parse($new[$key])->toTimeString();
                                                                $expectedTime = Carbon\Carbon::parse('09:00:00')->toTimeString();
                
                                                                if ($arrivalTime == $expectedTime) {
                                                                    $status = '<span class="badge bg-success">P</span>';
                                                                } elseif ($arrivalTime < $expectedTime) {
                                                                    $status = '<span class="badge bg-info">E</span>';
                                                                } else {
                                                                    $status = '<span class="badge bg-warning">L</span>';
                                                                }
                                                            }
                                                            else {
                                                                $status = '<span class="badge bg-secondary"></span>';
                                                            }
                                                            @endphp
                                                            {{-- {{ $new[$day . '_' . $employee->id] ?? "" }} --}}
                                                            {!! $status !!}

                                                        </td>
                                                    @endforeach
                                                    </tr>
                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
