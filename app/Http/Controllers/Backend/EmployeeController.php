<?php

namespace App\Http\Controllers\Backend;
use App\Models\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function ViewEmployee() {
        $EmpData = Employee::get();
      return  view('backend.View_Employee', compact('EmpData'));
    
    }


    public function AddEmployeeForm ()
    {
        return view('Backend.add_employee');
    }


    public function AddingEmployee (Request $request)
    {
        // Validation rules
        $validatedata = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:200|unique:employees',
            'phone' => 'required|max:200',
            'address' => 'required|max:200',
            'salary' => 'required|max:200',
        ],
        [

            'email.required' => 'Custom Message For Email Required',

        ]
);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'holidays' => $request->holidays,
            'city' => $request->city,
        ];

        // Handle image upload and storage (assuming you are using Laravel's file handling)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_generate = time() . '_' . $image->getClientOriginalName();
            $image->move('upload/employee/', $name_generate);
            $data['image'] = $name_generate;
        }

        Employee::create($data);
        return redirect()->route('view.employee')->with('success', 'Employee Added Sucessfully');

    }

    public function UpdateEmployee($id) {

        $employee = Employee::findOrFail($id);
        return view('Backend.update_employee',compact('employee'));

    }

    public function UpdatingEmployee(Request $request, $id) {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'holidays' => $request->holidayzs,
                'city' => $request->city,
            ];

            // Handle image upload and storage (assuming you are using Laravel's file handling)
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name_generate = time() . '_' . $image->getClientOriginalName();
                $image->move('upload/employee/', $name_generate);
                $data['image'] = $name_generate;
            }

            Employee::findOrFail($id)->update($data);
            return redirect()->route('view.employee')->with('success', 'Employee Updated Sucessfully');

    }

    public function DeleteEmployee($id){

        $employee = Employee::findOrFail($id);
        $img = $employee->image;

        @unlink($img);

        Employee::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Employee Deleted Sucessfully');

    } // End Method



}
