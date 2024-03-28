<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Customer;
use App\Models\CustomerDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use PHPUnit\TestRunner\TestResult\Collector;

class CollectionController extends Controller
{

    public function Index()
    {
        $collections = Collection::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('due_collection_id','DESC')->get();
        return view('admin.due_collection.index', compact('collections'));
    }

    public function Create()
    {
        $users = User::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.due_collection.create', compact('users'));
    }
    public function Store(Request $request)
    {
        $v_id = 1;
        $isExist = Collection::where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if ($isExist) {
            $invoice_id = Collection::where('customer_id', Auth::guard('admin')->user()->id)->max('invoice_id');
            $data['invoice_id'] = $this->formatSrl(++$invoice_id);
        } else {
            $data['invoice_id'] = 'INV-'.$this->formatSrl($v_id);
        }

        if ($isExist) {
            $due_collection_id = Collection::where('customer_id', Auth::guard('admin')->user()->id)->max('due_collection_id');
            $data['due_collection_id'] = $this->formatSrl(++$due_collection_id);
        } else {
            $data['due_collection_id'] = 'D_COLL_ID-'.$this->formatSrl($v_id);
        }

        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['auth_id'] = Auth::guard('admin')->user()->id;
        $data['user_id'] = $request->user_id;
        $data['amount'] = $request->amount;
        $data['date'] = date('d');
        $data['month'] = date('m');
        $data['year'] = date('Y');
        // dd($data);
        $collection = Collection::create($data);
        if ($collection) {
            $notification = array('message' => 'Due Collection Successfully.', 'alert_type' => 'success');
            return redirect()->route('collections.index')->with($notification);
        } else {
            $notification = array('message' => 'Something Went Wrong.', 'alert_type' => 'danger');
            return redirect()->back()->with($notification);
        }
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

        // Income Management generate income voucher 
        public function GenerateInv($id)
        {
            $inv = Collection::where('customer_id', Auth::guard('admin')->user()->id)->where('invoice_id', $id)->first();
            $user = User::where('customer_id', Auth::guard('admin')->user()->id)->where('user_id', $id)->first();
            $customer = Customer::where('id', Auth::guard('admin')->user()->id)->first();
            $custDetails = CustomerDetail::where('customer_id', $customer->id)->first();
    
            $data = [
                'inv' => $inv,
                'user' => $user,
                'customer' => $customer,
                'custDetails' => $custDetails,
            ];
            $pdf = PDF::loadView('admin.due_collection.invoice', $data);
            return $pdf->stream('due_collection.pdf');
        }
    
}
