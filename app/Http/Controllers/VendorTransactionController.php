<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\VendorTransaction;


class VendorTransactionController extends Controller
{
    public function all()
    {
        $vendor_transactions = VendorTransaction::all();
        return response()->json($vendor_transactions);
    }

    public function payment_request(Request $request)
    {
        try{
            $request->validate([
                'uid' => 'required', 
                'account_no' => 'required',
                'amount' => 'required',
                'status' => 'required'   
            ]);
            $vendor_transaction = VendorTransaction::create($request->all());
        }
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => ' Transaction issue! try again !',
                'error' => $e->getMessage(),
            ]);
            echo $e->getMessage();
        }
    return response()->json([
        'message' => ' Transaction Created Successfully',
        'error' => 'no',
        'Api_result' => $vendor_transaction
        // Add the remaining code part
    ]);
    }

    public function transaction_info(){
        $vendor_transaction = VendorTransaction::pluck('status', 'amount');
        return response()->json([
            'message' => ' Transaction retrieved Successfully',
            'Api_result' => $vendor_transaction       
        ]);
    }

    public function all_transactions()
    {
        $vendor_transactions = VendorTransaction::all();
        return view('admin.payment.index', compact('vendor_transactions'));
    }


}