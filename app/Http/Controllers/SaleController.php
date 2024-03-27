<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class SaleController extends Controller
{
    public function create()
    {
        $users = User::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $cats = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $products = Product::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.products.sales.create', compact('users', 'cats', 'products'));
    }
}
