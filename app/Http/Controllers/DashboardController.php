<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Sale;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function ViewDashboard() {
        $stock = Stock::get();
        $sales = Sale::get();
        
        return view('index', compact('stock','sales'));
    }
}
