<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
     // index method 
     public function index(Request $request)
     {
         if ($request->ajax()) {
             $imgurl = "files/product";
             $purchase = "";
             $query = DB::table('payments')->leftJoin('suppliers', 'payments.supplier_id', 'suppliers.id');
           
             if ($request->supplier_id) {
                 $query->where('payments.supplier_id', $request->supplier_id);
             }
             $purchase = $query->select('purchases.*', 'categories.name', 'suppliers.supplier_name')->get();
 
             return DataTables::of($purchase)
                 ->addIndexColumn()
                 ->addColumn('action', function ($row) {
                     $actionbtn = ' 
                     <a href="' . route('purchase.edit', [$row->id]) . '" class="btn btn-sm btn-info" ><i class="fas fa-edit"></i></a> 
                     <a href="" class="btn btn-sm btn-primary" ><i class="fas fa-eye"></i></a> 
                      <a href="' . route('purchase.delete', [$row->id]) . '"  class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
                     return $actionbtn;
                 })
                 ->rawColumns(['action', 'name'])
                 ->make(true);
         }
 
         $category = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
         $supplier = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->get();
         // $brand = Brand::all();
         // $warehouse = Warehouse::all();
         return view('admin.products.purchase.index', compact('category','supplier'));
     }
 
     public function create()
     {
         $cats = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
         $supplier = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->get();
         return view('admin.products.purchase.create', compact('cats', 'supplier'));
     }
 
     public function store(Request $request)
     {
         // dd($request);

        
         $total_amount = $request->product_unit * $request->product_unit_per_rate;
         $discount_amount = ($total_amount * $request->discount_rate)/100;
         $total_amount_after_discount = $total_amount - $discount_amount;
 
        //  dd($total_amount_after_discount);
        $purchase = Purchase::insert([
             'customer_id' => Auth::guard('admin')->user()->id,
             'auth_id' => Auth::guard('admin')->user()->id,
             'category_id' => $request->category_id,
             'supplier_id' => $request->supplier_id,
             'product_code' => $request->product_code,
             'product_name' => $request->product_name,
             'product_unit' => $request->product_unit,
             'product_unit_per_rate' => $request->product_unit_per_rate,
             'total_price_without_discount' => $total_amount,
             'discount' => $request->discount_rate,
             'discount_price' => $discount_amount,
             'total_price_after_discount' => $total_amount_after_discount,
             'paid' => $request->paid,
             'due' => $total_amount_after_discount - $request->paid,
             'date' => date('d'),
             'month' => date('m'),
             'year' => date('Y'),
 
         ]);

         $notification = array('message' => 'Product added successfully.', 'alert_type' => 'success');
         return redirect()->route('purchase.index')->with($notification);
         // return redirect()->route('product.index')->with($notification);
     }
 
     // product edit method
     public function edit($id)
     {
         $cats = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
         $supplier = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->get();
         $purchase = Purchase::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
         return view('admin.products.purchase.edit', compact('cats', 'supplier', 'purchase'));
     }
 
     // Update Product 
     public function update(Request $request)
     {
         $id = $request->id;
         $slug = Str::slug($request->product_name, '-');
 
         // Using Querybuilder
         $data = Product::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
         $data['category_id'] = $request->category_id;
         $data['supplier_id'] = $request->supplier_id;
         $data['product_code'] = $request->product_code;
         $data['product_name'] = $request->product_name;
         $data['product_slug'] = Str::slug($request->product_name, '-');
         $data['product_unit'] = $request->product_unit;
         $data['purchase_price'] = $request->purchase_price;
         $data['selling_price'] = $request->selling_price;
         $data['descount_price'] = $request->descount_price;
 
         if ($request->product_thumbnail) {
             if (File::exists($request->old_image)) {
                 unlink($request->old_image);
             }
             $slug = Str::slug($request->product_name, '-');
             $thumbnail = $request->product_thumbnail;
             $thumbnail_name = $slug . '.' . $thumbnail->getClientOriginalExtension();
             $thumbnail->move(public_path('/files/product'), $thumbnail_name);
             $thumbnail_url = '/files/product/' . $thumbnail_name;
             $data['product_thumbnail'] = $thumbnail_url;
         } else {
             $data['product_thumbnail'] = $request->old_image;
         }
         // dd($data);
         $data->save();
         $notification = array('message' => 'Product updated successfully.', 'alert_type' => 'success');
         return redirect()->route('product.index')->with($notification);
     }
 
     // create category 
     public function destroy($id)
     {
         $data = Product::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
         $data->delete();
         $notification = array('message' => 'Product deleted successfully.', 'alert_type' => 'danger');
         return redirect()->route('product.index')->with($notification);
     }
}
