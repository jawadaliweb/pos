<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Models\PaySalary;

class SalaryController extends Controller
{
    public function AddAdvanceSalary() {
        
        $empdata = Employee::latest()->get();
        return view('backend.salary.add_advance_salary', compact('empdata'));
    }

    public function StoreAdvanceSalary(Request $request) {

        $validatedata = $request->validate([
            'date' => 'required',
            'advance_salary' => 'required|max:255',
        ]);
    
        $date = $request->date;
        $employee_id = $request->employee_id;
        $advance = AdvanceSalary::where('date', $date)->where('employee_id', $employee_id)->first();
        $employee = Employee::findOrFail($employee_id);
    
        // Get the current month and year
        $currentMonth = date('m');
        $requestedMonth = date('m', strtotime($date));
    
        if ($request->advance_salary >= 0 && $request->advance_salary != 0) { // Check if the requested advance salary is non-negative
            if ($employee->salary >= $request->advance_salary) {
                if ($requestedMonth >= $currentMonth) {
                    if (!$advance) {
                        AdvanceSalary::create([
                            'employee_id' => $request->employee_id,
                            'date' => $request->date,
                            'advance_salary' => $request->advance_salary,
                            'status' => 0,
                        ]);
                        return redirect()->back()->with('success', 'Advance Added Successfully');
                    } else {
                        return redirect()->back()->with('warning', 'You already took advance this month');
                    }
                } else {
                    return redirect()->back()->with('error', 'Cannot request advance for a past month');
                }
            } else {
                return redirect()->back()->with('error', 'Advance salary cannot be greater than the employee\'s current salary');
            }
        } else {
            return redirect()->back()->with('error', 'Advance Greater then '. $request->advance_salary);
        }
        
    }


    public function AllAdvanceSalary() {
        $AdvanceSalaries  = AdvanceSalary::latest()->get();
        return view('backend.salary.view_salaries', compact('AdvanceSalaries'));
        // echo "<pre>";
        // print_r($AdvanceSalaries);
        // echo "</pre>";
        // die();
        
    }

    public function DeleteAdvance($id){
        $advance = AdvanceSalary::findOrFail($id);
        $img = $advance->image;
        @unlink($img);
        AdvanceSalary::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Advance Salary Deleted Sucessfully');
    }

    public function UpdateAdvance($id) {
        $AdvanceSalary = AdvanceSalary::findOrFail($id);
        return view('Backend.salary.update_advance_salary',compact('AdvanceSalary'));
    }

    public function UpdatingAdvance(Request $request, $id){
        $advance = AdvanceSalary::findOrFail($id);
        //getting current employee salary using ID param and relationship in model
        $employee = $advance->employee;
        $newAdvanceAmount = $request->advance_salary;
    
        if ($employee->salary >= $newAdvanceAmount) {
            $advance->update([
                'date' => $request->date,
                'advance_salary' => $newAdvanceAmount,
            ]);
            return redirect()->route('all.advance.salary')->with('success', 'Advance Updated Successfully');
        }
    
        return redirect()->back()->with('error', 'Advance salary cannot be greater than the employee\'s current salary');
    }

    
    public function PaySalary() {
        $prev_month = date('F', strtotime('-1 month'));
        $paid_salaries_empids = PaySalary::where('date', $prev_month)->pluck('employee_id');
        // $employees_data = Employee::with('advance')
        // ->whereNotIn('id', $paid_salaries_empids)
        // ->get();
        $employees_data = Employee::with('advance')->get();
        
        // echo "<pre>";
        // echo $salaries;
        // echo "</pre>";
        // die();
        return view('backend.salary.pay_salaries', compact('employees_data', 'paid_salaries_empids'));
    }


    public function PayNowSalary($id) {
        $employee = Employee::findOrFail($id);
        return view('backend.salary.pay_employee_salary', compact('employee'));
    }
    
    public function StoreSalary(Request $request) {
        $employee_id = $request->input('employee_id');

        PaySalary::create([
            'employee_id' => $employee_id, // Pass the actual employee ID, not the string 'employee_id'
            'date' => $request->date,
            'advance_salary' => $request->advance_salary,
            'paid_amount' => $request->paid_amount,
            'total_salary' => $request->total_salary,
        ]);

        $advance_ids = AdvanceSalary::where('employee_id', $employee_id)->where('status', 0)->get();
        foreach ($advance_ids as $advance) {
            $advance->update(['status' => 1]);
        }
        
    
        return redirect()->route('PaySalary')->with('success', 'Salary Paid Successfully');
    }

    public function PaidSalaries() {
        $paidsalary = PaySalary::latest()->get();
        return view('backend.salary.paid_salary', compact('paidsalary'));
    }
    
    
}
