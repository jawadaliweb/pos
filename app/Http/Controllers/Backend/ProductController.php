<?php

namespace App\Http\Controllers\Backend;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ProductList() {
        $products = Product::with('category')->get();
        $categories = category::get();

        // echo '<pre>';
        // echo json_encode($products, JSON_PRETTY_PRINT);
        // echo '</pre>';
        // die();

        return view('backend.product.product_list', compact('products','categories'));
    }

    public function AddProduct(Request $request) {
        $data = [
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'category_id' => $request->category_id,
            'sale_price' => $request->sale_price,
        ];
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $name_generate = time() . '_' . $image->getClientOriginalName();
            $image->move('upload/product/', $name_generate);
            $data['product_image'] = $name_generate;
        }
        
        Product::create($data);
        return redirect()->back()->with('success','Product Successfully Added')->withInput();
    }

    public function DeleteProduct($id) {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Product deleted Successfully');
    }

    public function UpdateProduct($id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('backend.product.update_product', compact('product', 'categories'));
    }


    public function UpdatingProduct(Request $request, $id) {
        $data = [
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'category_id' => $request->category_id,
            'sale_price' => $request->sale_price,
        ];
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $name_generate = time() . '_' . $image->getClientOriginalName();
            $image->move('upload/product/', $name_generate);
            $data['product_image'] = $name_generate;
        }
        Product::findOrfail($id)->update($data);
        return redirect('/product/list')->with('success', 'product updated succesfully');
    }
}
