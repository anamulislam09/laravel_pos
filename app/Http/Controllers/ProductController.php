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
            $query = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id');
            if ($request->category_id) {
                $query->where('products.category_id', $request->category_id);
            }
            $product = $query->select('products.*', 'categories.name')->get();

            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = ' 
                    <a href="' . route('product.edit', [$row->product_id]) . '" class="btn btn-sm btn-info" ><i class="fas fa-edit"></i></a> 
                    <a href="" class="btn btn-sm btn-primary" ><i class="fas fa-eye"></i></a> 
                     <a href="' . route('product.delete', [$row->product_id]) . '"  class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
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
        return view('admin.products.product.create', compact('cats'));
    }

    public function store(Request $request)
    {
        $pr_id = 1;
        $isExist  = Product::where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if ($isExist) {
            $product_id = Product::where('customer_id', Auth::guard('admin')->user()->id)->max('product_id');
            $data['product_id'] =  $this->formatSrl(++$product_id);
        } else {
            $data['product_id'] = 'PR-' . $this->formatSrl($pr_id);
        }
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['auth_id'] = Auth::guard('admin')->user()->id;
        $data['category_id'] = $request->category_id;
        $data['product_name'] = $request->product_name;
        $data['quantity_status'] = $request->quantity_status;
        $data['date'] = date('d');
        $data['month'] = date('m');
        $data['year'] = date('Y');
        Product::create($data);
        $notification = array('message' => 'Product added successfully.', 'alert_type' => 'success');
        return redirect()->route('product.index')->with($notification);
        // return redirect()->route('product.index')->with($notification);
    }

    public function formatSrl($srl)
    {
        switch (strlen($srl)) {
            case 1:
                $zeros = '000000';
                break;
            case 2:
                $zeros = '00000';
                break;
            case 3:
                $zeros = '0000';
                break;
            case 4:
                $zeros = '000';
                break;
            case 5:
                $zeros = '00';
                break;
            default:
                $zeros = '0';
                break;
        }
        return $zeros . $srl;
    }

    

    // product edit method
    public function edit($id)
    {

        $cats = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $product = Product::where('customer_id', Auth::guard('admin')->user()->id)->where('product_id', $id)->first();
        return view('admin.products.product.edit', compact('cats', 'product'));
    }

    // Update Product 
    public function update(Request $request)
    {
        $id = $request->id;
        // dd($id);
        // Using Querybuilder
        $data = Product::where('customer_id', Auth::guard('admin')->user()->id)->where('product_id', $id)->first();
        
        $data['category_id'] = $request->category_id;
        $data['product_name'] = $request->product_name;
        $data['quantity_status'] = $request->quantity_status;

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
