<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $query = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')
                ->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
                ->leftJoin('brands', 'products.brand_id', 'brands.id');
            if ($request->category_id) {
                $query->where('products.category_id', $request->category_id);
            }
            if ($request->brand_id) {
                $query->where('products.brand_id', $request->brand_id);
            }
            if ($request->warehouse_id) {
                $query->where('products.warehouse', $request->warehouse_id);
            }
            if ($request->status == 1) {
                $query->where('products.status', 1);
            } elseif ($request->status == 0) {
                $query->where('products.status', 0);
            }
            $product = $query->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                //featured column start here
                ->editColumn('featured', function ($row) {
                    if ($row->featured == 1) {
                        return ' <a href="#" data-id= "' . $row->id . '" class="deactive_featured" ><i class="fas fa-thumbs-down text-danger pr-1"></i><span class="badge badge-success ">active</span></a>';
                    } else {
                        return ' <a href="#" data-id= "' . $row->id . '" class="active_featured" ><i class="fas fa-thumbs-up text-primary pr-1"></i><span class="badge badge-danger ">deactive</span></a>';
                    }
                })         //featured column ends here
                //today_deal column start here
                ->editColumn('today_deal', function ($row) {
                    if ($row->today_deal == 1) {
                        return ' <a href="#" data-id= "' . $row->id . '"class="deactive_todayDeal" ><i class="fas fa-thumbs-down text-danger pr-1"></i><span class="badge badge-success ">active</span></a>';
                    } else {
                        return ' <a href="#" data-id= "' . $row->id . '" class="active_todayDeal" ><i class="fas fa-thumbs-up text-primary pr-1"></i><span class="badge badge-danger ">deactive</span></a>';
                    }
                })         //today_deal column ends here
                //status column start here
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return ' <a href="#" data-id= "' . $row->id . '"class="deactive_status" ><i class="fas fa-thumbs-down text-danger pr-1"></i><span class="badge badge-success ">active</span></a>';
                    } else {
                        return ' <a href="#" data-id= "' . $row->id . '" class="active_status" ><i class="fas fa-thumbs-up text-primary pr-1"></i><span class="badge badge-danger ">deactive</span></a>';
                    }
                })         //status column ends here
                ->addColumn('action', function ($row) {
                    $actionbtn = ' 
                    <a href="' . route('product.edit', [$row->id]) . '" class="btn btn-sm btn-info" ><i class="fas fa-edit"></i></a> 
                    <a href="" class="btn btn-sm btn-primary" ><i class="fas fa-eye"></i></a> 
                     <a href="' . route('product.delete', [$row->id]) . '"  class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'category_name', 'subcategory_name', 'featured', 'today_deal', 'status'])
                ->make(true);
        }

        $category = Category::where('customer_id', Auth::guard('admin')->user()->id)->all();
        // $brand = Brand::all();
        // $warehouse = Warehouse::all();
        return view('admin.products.product.index', compact('category'));
    }

    public function create()
    {
        $cats = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
        // $brands = Brand::all();
        // $warehouses = Warehouse::all();
        return view('admin.products.product.create', compact('cats'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $slug = Str::slug($request->product_name, '-');
        // Image upload start here
        if ($request->hasFile('images')) {
            $thumbnail = $request->product_thumbnail;
            $thumbnail_name = $slug . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('files/product'), $thumbnail_name);
            $thumbnail_url = 'files/product/' . $thumbnail_name;
        }

        dd($request);
        Product::insert([
            'customer_id' => Auth::guard('admin')->user()->id,
            'auth_id' => Auth::guard('admin')->user()->id,
            'category_id' => $request->category_id,
            // 'supplier_id' => $request->supplier_id,
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
            'year' => date('F'),

        ]);
        $notification = array('message' => 'Product added successfully.', 'alert_type' => 'success');
        return redirect()->route('product.index')->with($notification);
        // return redirect()->route('product.index')->with($notification);
    }
}
