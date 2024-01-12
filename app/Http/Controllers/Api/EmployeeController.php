<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->get();
        $employees->transform(function ($employee) {
            $employee->image = asset('images/'.$employee->image);
            return $employee;
        });
        return response()->json($employees);
        
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(Request $request)
     {
         $data = $request->all();
     
         // Define validation rules with custom error messages
         $rules = [
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:employees,email',
             'phone' => 'required|string|max:20',
             'address' => 'required|string',
             'experience' => 'required|string',
             'salary' => 'required|numeric',
             'holidays' => 'required|integer',
             'city' => 'required|string',

         ];
     
         // Create a validator instance with custom error messages
         $validator = \Validator::make($data, $rules);
     
         // Check if the validation fails
         if ($validator->fails()) {
             // Return validation errors with a 422 Unprocessable Entity status code
             return response()->json(['errors' => $validator->errors()], 400);
         }
     
         // Handle image upload
         if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] =  $imageName;
        } 
     
         // If validation passes and image is uploaded, create the employee
         $emp = Employee::create($data);
     
         return response()->json($emp);
     }
     
     

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the employee record by ID
        $employee = Employee::find($id);
    
        // Check if the employee record exists
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    
        return response()->json($employee);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
       
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all(); // Get all data from the request
        $employee = Employee::findOrFail($id); // Find the employee by ID
        if (!$employee) {
            return response('Employee not found', 404); // Return a 404 response if the employee is not found
        }
    
        $employee->update($data); // Update the employee data
        return response('Updated successfully');
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::find($id)->delete();
        return response()->json(['message' => 'delete sucessfully']);
    }
}
