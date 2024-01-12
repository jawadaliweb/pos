<?php

namespace App\Http\Controllers\Backend;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Imports\ProductImport;

class ProductImportController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('products_file');
    
        if ($file) {
            Excel::import(new ProductImport, $file);
    
            return redirect()->back()->with('success', 'Products imported successfully.');
        } else {
            return redirect()->back()->with('error', 'No file uploaded.');
        }
    }
    
}