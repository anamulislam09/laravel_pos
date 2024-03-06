<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function Index()
    {
        // if (Auth::guard('admin')->user()->role == 0) {
        $data = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.supplier.index', compact('data'));
        // } else {
        //     $notification = array('message' => 'You have no permission.', 'alert_type' => 'warning');
        //     return redirect()->back()->with($notification);
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Store(Request $request)
    {

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['auth_id'] = Auth::guard('admin')->user()->id;
        $data['supplier_name'] = $request->supplier_name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['month'] = $month;
        $data['year'] = $year;
        $data['date'] = date('d');
        Supplier::create($data);

        return redirect()->route('supplier.index')->with('message', 'Supplier creted successfully');
    }

    public function Edit($id)
    {
        $data = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
        // dd($data);
        return view('admin.supplier.edit', compact('data'));
    }

    public function Update(Request $request)
    {
        $data = Supplier::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $request->id)->first();
        $data['supplier_name'] = $request->supplier_name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        // dd($data);
        $data->save();

        return redirect()->route('supplier.index')->with('message', 'Category Updated successfully');
    }

    public function Destroy($id)
    {
        $data = Category::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
        $data->delete();
        return redirect()->route('category.index')->with('message', 'Category deleted successfully.');
    }
}
