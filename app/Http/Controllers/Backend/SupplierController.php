<?php

namespace App\Http\Controllers\Backend;
use App\Models\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function ViewSuppliers() {
        $Suppdata = Supplier::get();
      return  view('backend.supplier.View_Supplier', compact('Suppdata'));
    }


    public function AddingSupplier (Request $request)
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
            $image->move('upload/supplier/', $name_generate);
            $data['image'] = $name_generate;
        }

        Supplier::create($data);
        return redirect()->route('view.suppliers')->with('success', 'supplier Added Sucessfully');

    }


    public function UpdateSupplier($id) {

        $supplier = Supplier::findOrFail($id);
        return view('Backend.supplier.update_supplier',compact('supplier'));

    }

    public function SupplierDetails($id) {

        $supplier = Supplier::findOrFail($id);
        return view('Backend.supplier.view_supplier_details',compact('supplier'));

    }


    public function UpdatingSupplier (Request $request, $id)
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
            $image->move('upload/supplier/', $name_generate);
            $data['image'] = $name_generate;
        }

        Supplier::findOrFail($id)->update($data);
        return redirect()->route('view.suppliers')->with('success', 'Supplier Updated Sucessfully');
    }

    public function DeleteSupplier($id){

        $supplier = Supplier::findOrFail($id);
        $img = $supplier->image;

        @unlink($img);

        Supplier::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'supplier Deleted Sucessfully');

    } // End Method


}
