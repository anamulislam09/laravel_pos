<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PaymentVoucher;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    // index method 
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imgurl = "files/product";
            $purchase = "";
            $query = DB::table('purchases')->leftJoin('categories', 'purchases.category_id', 'categories.id')->leftJoin('products', 'purchases.product_id', 'products.product_id')->leftJoin('suppliers', 'purchases.supplier_id', 'suppliers.id');
            if ($request->category_id) {
                $query->where('purchases.category_id', $request->category_id);
            }
            if ($request->product_id) {
                $query->where('products.product_id', $request->product_id);
            }
            if ($request->supplier_id) {
                $query->where('purchases.supplier_id', $request->supplier_id);
            }
            $purchase = $query->select('purchases.*', 'categories.name', 'products.product_name', 'suppliers.supplier_name')->get();

            return DataTables::of($purchase)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = ' 
                     <a href="' . route('purchase.edit', [$row->id]) . '" class="btn btn-sm btn-info" ><i class="fas fa-edit"></i></a> ';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }

        //  <a href="" class="btn btn-sm btn-primary" ><i class="fas fa-eye"></i></a> 
        //   <a href="' . route('purchase.delete', [$row->id]) . '"  class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

        $category = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $supplier = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->get();
        // $brand = Brand::all();
        // $warehouse = Warehouse::all();
        return view('admin.products.purchase.index', compact('category', 'supplier'));
    }

    public function create()
    {
        $cats = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $supplier = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.products.purchase.create', compact('cats', 'supplier'));
    }

    public function store(Request $request)
    {
        dd($request);
        $product = Product::where('customer_id', Auth::guard('admin')->user()->id)->where('product_id', $request->product_id)->first();

        $total_amount = $request->product_quantity * $request->product_unit_per_rate;
        $discount_amount = ($total_amount * $request->discount_rate) / 100;
        $total_amount_after_discount = $total_amount - $discount_amount;

        $v_id = 1;
        $isExist = Purchase::where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if ($isExist) {
            $purchase_voucher_id = Purchase::where('customer_id', Auth::guard('admin')->user()->id)->max('purchase_voucher_id');
            $data['purchase_voucher_id'] = $this->formatSrl(++$purchase_voucher_id);
        } else {
            $data['purchase_voucher_id'] = 'PINV-' . $this->formatSrl($v_id);
        }
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['auth_id'] = Auth::guard('admin')->user()->id;
        $data['supplier_id'] = $request->supplier_id;
        $data['total_price_without_discount'] = $total_amount;
        $data['paid'] = $request->paid;
        $data['due'] = $total_amount_after_discount - $request->paid;
        $data['date'] = date('d');
        $data['month'] = date('m');
        $data['year'] = date('Y');
        // dd($data);
        $purchase = Purchase::create($data);
        if ($purchase) {
            $product = $request->product;
            $qty = $request->qty;
            $qty_rate = $request->qty_rate;

            // for ($i = 0; $i < count($product); $i++) {
            //     Question::insert([
            //         'questions' => $questions[$i],
            //         'remarks' => $remarks[$i],
            //     ]);
            // }
            $purchase_item = Purchase::where('customer_id', Auth::guard('admin')->user()->id)->latest()->first();
            $data['customer_id'] = Auth::guard('admin')->user()->id;
            $data['auth_id'] = Auth::guard('admin')->user()->id;
            $data['purchase_voucher_id'] = $purchase_item->purchase_voucher_id;
            $data['supplier_id'] = $purchase_item->supplier_id;
            $data['amount'] = $purchase_item->total_price_after_discount;
            $data['paid'] = $purchase_item->paid;
            $data['due'] = $purchase_item->due;
            $data['date'] = date('d');
            $data['month'] = date('m');
            $data['year'] = date('Y');
            $payment_voucher = PaymentVoucher::create($data);
        }
        if ($purchase) {
            $purchase_item = Purchase::where('customer_id', Auth::guard('admin')->user()->id)->latest()->first();

            $data['customer_id'] = Auth::guard('admin')->user()->id;
            $data['auth_id'] = Auth::guard('admin')->user()->id;
            $data['purchase_voucher_id'] = $purchase_item->purchase_voucher_id;
            $data['supplier_id'] = $purchase_item->supplier_id;
            $data['amount'] = $purchase_item->total_price_after_discount;
            $data['paid'] = $purchase_item->paid;
            $data['due'] = $purchase_item->due;
            $data['date'] = date('d');
            $data['month'] = date('m');
            $data['year'] = date('Y');
            $payment_voucher = PaymentVoucher::create($data);
        }
        if ($payment_voucher) {
            $notification = array('message' => 'Purchase Successfully.', 'alert_type' => 'success');
            return redirect()->route('purchase.index')->with($notification);
        } else {
            $notification = array('message' => 'Something Went Wrong.', 'alert_type' => 'danger');
            return redirect()->back()->with($notification);
        }

        // $questions = $request->questions;
        // $remarks = $request->remarks;
        // for($i=0; $i<count($questions); $i++){
        //     Question::insert([
        //         'questions' => $questions[$i],
        //         'remarks' => $remarks[$i],
        //     ]);
        // }

    }

    // insert sub category category using ajax request
    public function GetProduct(Request $request)
    {
        $categoryid = $request->post('categoryid');
        //  dd($categoryid);
        $products = DB::table('products')->where('customer_id', Auth::guard('admin')->user()->id)->where('category_id', $categoryid)->orderBy('product_name', 'ASC')->get();
        $html = '<option value="" selected disabled>Select One</option>';
        foreach ($products as $list) {
            $html .= '<option value="' . $list->product_id . '">' . $list->product_name . '</option>';
        }
        echo $html;
    }

    // unique id serial function
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
        $supplier = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $products = Product::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $purchase = Purchase::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
        return view('admin.products.purchase.edit', compact('cats', 'supplier', 'purchase', 'products'));
    }

    // Update Product 
    public function update(Request $request)
    {
        $id = $request->purchase_voucher_id;

        $total_amount = $request->product_quantity * $request->product_unit_per_rate;
        $discount_amount = ($total_amount * $request->discount_rate) / 100;
        $total_amount_after_discount = $total_amount - $discount_amount;

        // Using Querybuilder
        $data = Purchase::where('customer_id', Auth::guard('admin')->user()->id)->where('purchase_voucher_id', $id)->first();
        $data['supplier_id'] = $request->supplier_id;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_unit_per_rate'] = $request->product_unit_per_rate;
        $data['discount'] = $request->discount_rate;
        $data['paid'] = $request->paid;

        $data['total_price_without_discount'] = $total_amount;
        $data['discount_price'] = $discount_amount;
        $data['total_price_after_discount'] = $total_amount_after_discount;
        $data['due'] = $total_amount_after_discount - $request->paid;

        $purchaseUpdate = $data->save();
        if ($purchaseUpdate) {
            $purchase_item = Purchase::where('customer_id', Auth::guard('admin')->user()->id)->where('purchase_voucher_id', $id)->first();
            $data = PaymentVoucher::where('customer_id', Auth::guard('admin')->user()->id)->where('purchase_voucher_id', $purchase_item->purchase_voucher_id)->first();

            $data['supplier_id'] = $purchase_item->supplier_id;
            $data['amount'] = $purchase_item->total_price_after_discount;
            $data['paid'] = $purchase_item->paid;
            $data['due'] = $purchase_item->due;
            $payment_voucher = $data->save();
        }
        if ($payment_voucher) {
            $notification = array('message' => 'Purchase updated successfully.', 'alert_type' => 'success');
            return redirect()->route('purchase.index')->with($notification);
        } else {
            $notification = array('message' => ' Something Went Wrong .', 'alert_type' => 'danger');
            return redirect()->back()->with($notification);
        }
    }

    // create category 
    // public function destroy($id)
    // {
    //     $data = Product::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
    //     $data->delete();
    //     $notification = array('message' => 'Product deleted successfully.', 'alert_type' => 'danger');
    //     return redirect()->route('product.index')->with($notification);
    // }
}
