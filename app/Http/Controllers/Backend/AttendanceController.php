<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
    public function EmployeeAttendanceList(Request $request) {

           // Validate the request, ensure the input is in the correct format (YYYY-MM).
        $request->validate([
            'date' => 'nullable|date_format:Y-m',
        ]);

        // Get the selected date from the request; use the current date if it's not provided
        $selectedDate = $request->input('date', Carbon::now()->format('Y-m'));

        // Extract the year and month from the selected date
        list($year, $month) = explode('-', $selectedDate);

        // Use these values to filter the attendance records
        $attendance = Attendance::with('employee')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        // Other parts of your code...


        $new = $attendance->mapWithKeys(function ($item) {
            $date = \Carbon\Carbon::parse($item->date);
            $key = $date->day . '_' . $item->employee_id;
            return [$key => $item->date];
        });
        
        $employees = Employee::get();

        $currentMonth = now();
        $lastDayOfMonth = $currentMonth->endOfMonth();
        $range = range(1, $lastDayOfMonth->day);

        return view('backend.attendance.view_employee_attendance', [
            'attendance' => $attendance,
            'employees' => $employees,
            'range' => $range,
            'new' => $new,
        ]);
        
    
    }

    public function attendanceform() {
                
        $employees = Employee::latest()->get();
        return view('backend.attendance.Add_attendance', compact('employees'));
    }

    public function AddAttendance(Request $request) {
        $data = [
            'employee_id' => $request->input('employee_id'),
            'date' => $request->input('date'),
            'status' => "present",
        ];
    
        try {
            Attendance::create($data);
            return redirect('/employee/attendance')->with('success', "Attendance Added Successfully");
        } catch (\Throwable $th) {
            return redirect('/employee/attendance')->with('error', "Something went wrong!");
        }
    }
    
    
    
}
