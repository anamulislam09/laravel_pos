<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    // index method 
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imgurl = "files/product";
            $product = "";
            $query = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')->leftJoin('suppliers', 'products.supplier_id', 'suppliers.id');
            if ($request->category_id) {
                $query->where('products.category_id', $request->category_id);
            }
            if ($request->supplier_id) {
                $query->where('products.supplier_id', $request->supplier_id);
            }
            $product = $query->select('products.*', 'categories.name', 'suppliers.supplier_name')->get();

            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = ' 
                    <a href="' . route('product.edit', [$row->id]) . '" class="btn btn-sm btn-info" ><i class="fas fa-edit"></i></a> 
                    <a href="" class="btn btn-sm btn-primary" ><i class="fas fa-eye"></i></a> 
                     <a href="' . route('product.delete', [$row->id]) . '"  class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }

        $category = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
        // $brand = Brand::all();
        // $warehouse = Warehouse::all();
        return view('admin.products.product.index', compact('category'));
    }

    public function create()
    {
        $cats = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $supplier = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.products.product.create', compact('cats', 'supplier'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $slug = Str::slug($request->product_name, '-');
        // Image upload start here
        // if ($request->hasFile('image')) {
        $thumbnail = $request->product_thumbnail;
        $thumbnail_name = $slug . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move(public_path('/files/product'), $thumbnail_name);
        $thumbnail_url = '/files/product/' . $thumbnail_name;
        // }

        // dd($request);
        Product::insert([
            'customer_id' => Auth::guard('admin')->user()->id,
            'auth_id' => Auth::guard('admin')->user()->id,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_name' => $request->product_name,
            'product_slug' => Str::slug($request->product_name, '-'),
            // 'product_code' => $request->product_code,
            'product_unit' => $request->product_unit,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'descount_price' => $request->descount_price,
            // 'warehouse' => $request->warehouse,
            'product_thumbnail' => $thumbnail_url,
            'date' => date('d'),
            'month' => date('m'),
            'year' => date('Y'),

        ]);
        $notification = array('message' => 'Product added successfully.', 'alert_type' => 'success');
        return redirect()->route('product.index')->with($notification);
        // return redirect()->route('product.index')->with($notification);
    }

    // product edit method
    public function edit($id)
    {
        $cats = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $supplier = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $product = Product::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
        return view('admin.products.product.edit', compact('cats', 'supplier', 'product'));
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
