<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleStock;

class SaleController extends Controller
{
    //
    public function SaleView() {
        $categories = Category::get();
        $customers = Customer::get();
        $products = Product::get();
        return view('backend.sale.view_sales', compact('categories','customers','products'));
    }

    public function SaleStore(Request $request) {
        // print_r($request->all());
        // die();

          $this->validate($request, [
        'date' => 'required|date',
        'customer_id' => 'required|integer',
        'total_quantity' => 'required|integer',
        'total_amount' => 'required|numeric',
        'stocks' => 'required|array',
    ]);

        $date = $request->all()['date'];
        $customer_id = $request->all()['customer_id'];
        $total_quantity = $request->all()['total_quantity'];
        $total_amount = $request->all()['total_amount'];

        $data = [
            "date" => $date,
            "customer_id" => $customer_id,
            "total_quantity" => $total_quantity,
            "total_price" => $total_amount,
        ];
        $sale = new Sale($data);
        $sale->save();

        // ------------------------------ Stocks ------------------------------
        $stocks = $request->all()['stocks'];
        $salestocks = [];
        foreach ($stocks as $stock) {
            $stock_data = [
                "product_id" => $stock['productId'],
                "sales_id" => $sale->id,
                "quantity" => $stock['quantity'],
                "price" => $stock['salePrice'],
                "total_price" => $stock['salePrice'] * $stock['quantity'],
                "discount" => "0",
            ];
            $salestock = SaleStock::create($stock_data);
            array_push($salestocks, $salestock);

            $product = Product::findOrFail($stock['productId']);
            $product->quantity -= $stock['quantity'];
            $product->save();
        }

        

        return response()->json(["stocks"=> $salestocks, "purchase" => $sale]);
    }
    
}
