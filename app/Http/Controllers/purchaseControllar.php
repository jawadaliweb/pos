<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Stock;

class purchaseControllar extends Controller
{
    public function AddForm() {
        $suppliers = Supplier::get();
        $products = Product::get();
        return view('backend.purchase.view_purchase', compact('suppliers','products'));
    }

    public function AddPurchase(Request $request)
    {
        $total_price = 0;
    
        $purchase = new Purchase([
            'supplier_id' => $request->supplier_id,
            'date' => $request->date,
            'total_quantity' => array_sum($request->total_quantity),
            'total_price' => 0, // Initially set to 0, will be calculated later
        ]);
    
        $purchase->save();
    
        foreach ($request->product_id as $index => $productId) {
            $quantity = $request->total_quantity[$index];
            $price = $request->price[$index];
            $discount = $request->discount[$index] ?? 0;
    
            $stock = new Stock([
                'product_id' => $productId,
                'purchase_id' => $purchase->id,
                'quantity' => $quantity,
                'price' => $price,
                'discount' => $discount,
                'total_price' => ($quantity * $price) - $discount,
            ]);
    
            $stock->save();
    
            // Calculate the total price for the purchase
            $total_price += ($quantity * $price) - $discount;
    
            // Update the product's quantity
            $product = Product::findOrFail($productId);
            $product->quantity += $quantity;
            $product->save();
        }
    
        // Update the total price for the purchase after all products have been added
        $purchase->total_price = $total_price;
        $purchase->save();
    
        return redirect()->back()->with('success', 'Products Purchased Successfully');
    }
    

public function ViewPurchase(){
    $purchases = Purchase::with('stocks')->get();   
    return view('backend.purchase.purchase_list', compact('purchases'));
}



public function DeletePurchase($id) {
    // Retrieve the purchase
    $purchase = Purchase::findOrFail($id);

    // Iterate through the related stocks and update product quantities
    foreach ($purchase->stocks as $stock) {
        $product = $stock->product;
        $newQuantity = $product->quantity - $stock->quantity;
        
        // Ensure that the new quantity is not negative
        if ($newQuantity >= 0) {
            $product->quantity = $newQuantity;
            $product->save();
        } else {
            // Handle the case where the subtraction would result in a negative quantity (e.g., you can set the product quantity to 0 or any other appropriate action)
            $product->quantity = 0;
            $product->save();
        }

        
    }

    // Delete the purchase record
    $purchase->delete();

    return redirect()->back()->with('success', 'Purchase List Deleted Successfully');
}

public function DeleteStock($id) {
    // Retrieve the stock and its associated product

    $stock = Stock::findOrFail($id);
    $product = $stock->product;
    

    // $purchase = Purchase::findOrFail($stock->purchase_id);
    $purchase = $stock->purchase;

    $purchase->total_quantity -= $stock->quantity;
    $purchase->total_price -= $stock->total_price;

    $purchase->save();

    // Calculate the new product quantity, ensuring it's not negative
    $newQuantity = max(0, $product->quantity - $stock->quantity);
    $product->quantity = $newQuantity;

    $product->save();

    // Delete the stock record
    $stock->delete();

    // Delete purchases with no associated stocks
    Purchase::whereDoesntHave('stocks')->delete();

    return redirect()->back()->with('success', 'Stock Deleted Successfully');
}


}
