<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\Account;


class AccountController extends Controller
{
    public function all()
    {
        $accounts = Account::all();
        return response()->json($accounts);
    }

    public function payment_request(Request $request)
    {
        try{
            $request->validate([
                'uid' => 'required', 
                'earn' => 'required',
                'withdraw' => 'required',
                'status' => 'required'   
            ]);
            $account = Account::create($request->all());
        }
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => ' Account issue! try again !',
                'error' => $e->getMessage(),
            ]);
            echo $e->getMessage();
        }
    return response()->json([
        'message' => ' Account Created Successfully',
        'error' => 'no',
        'Api_result' => $account
        // Add the remaining code part
    ]);
    }

    public function account_info($id){
        $account = Account::findorfail($id);
        // $account = Account::pluck('status', 'amount');
        return response()->json([
            'message' => ' Transaction retrieved Successfully',
            'Api_result' => $account
        
        ]);
    }

    public function all_transactions()
    {
        $account = Account::all();
        return view('admin.payment.index', compact('account'));
    }


}