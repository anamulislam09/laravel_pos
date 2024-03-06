<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //

    public function Index()
    {
        // if (Auth::guard('admin')->user()->role == 0) {
            $data = Category::where('customer_id', Auth::guard('admin')->user()->id)->get();
            return view('admin.products.category.index', compact('data'));
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
            return view('admin.products.category.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Store(Request $request)
    {
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name, '-');
        Category::create($data);

        return redirect()->route('category.index')->with('message', 'Category creted successfully');
    }

    public function Edit($id)
    {
            $data = Category::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
            return view('admin.products.category.edit', compact('data'));
    }

    public function Update(Request $request)
    {
        $data = Category::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $request->id)->first();
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name, '-');
        // dd($data);
        $data->save();

        return redirect()->route('category.index')->with('message', 'Category Updated successfully');
    }

    public function Destroy($id)
    {
        $data = Category::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
        $data->delete();
        return redirect()->route('category.index')->with('message', 'Category deleted successfully.');
    }
}
