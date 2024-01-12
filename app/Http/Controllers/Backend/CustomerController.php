<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function ViewCustomer() {
        $customer_data = Customer::get();
      return  view('backend.customer.View_Customer', compact('customer_data'));
    }


    public function AddingCustomer (Request $request)
    {
        // Validation rules
        $validatedata = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|max:200|unique:customers',
            'phone' => 'required|max:200',
            'address' => 'required|max:200',
            'shopname' => 'required|max:200',
        ],
        [

            'email.required' => 'Custom Message For Email Required',

        ]
);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
        ];


        // Handle image upload and storage (assuming you are using Laravel's file handling)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_generate = time() . '_' . $image->getClientOriginalName();
            $image->move('upload/customer/', $name_generate);
            $data['image'] = $name_generate;
        }

        Customer::create($data);
        return redirect()->route('view.customer')->with('success', 'Customer Added Sucessfully');

    }


    public function UpdateCustomer($id) {

        $customer = Customer::findOrFail($id);
        return view('Backend.customer.update_customer',compact('customer'));

    }


    public function UpdatingCustomer (Request $request, $id)
    {


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
        ];


        // Handle image upload and storage (assuming you are using Laravel's file handling)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_generate = time() . '_' . $image->getClientOriginalName();
            $image->move('upload/customer/', $name_generate);
            $data['image'] = $name_generate;
        }

        Customer::findOrFail($id)->update($data);
        return redirect()->route('view.customer')->with('success', 'Customer Updated Sucessfully');

    }



    public function DeleteCustomer($id){

        $employee = Customer::findOrFail($id);
        $img = $employee->image;

        @unlink($img);

        Customer::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Customer Deleted Sucessfully');

    } // End Method



}
