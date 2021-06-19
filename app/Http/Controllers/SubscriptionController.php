<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\Subscription;


class SubscriptionController extends Controller
{
    public function all()
    {
        $subscriptions = Subscription::all();
        return response()->json($subscriptions);
    }

    public function add_sub(Request $request)
    {
        try{
            $request->validate([
                'uid' => 'required',
                'pid' => 'required',
                'status' => 'required',   
            ]);
            $subscription = Subscription::create($request->all());
        }
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => 'faulty connection, try again !',
                'error' => $e->getMessage(),
            ]);
            echo $e->getMessage();
        }
    return response()->json([
        'message' => ' Package Created Successfully',
        'error' => 'no',
        'Api_result' => $subscription
        // Add the remaining code part
    ]);
    }

    public function update(Request $request, $id)
    {
        try{
            $request->validate( [
              'uid' => 'required',
              'pid' => 'required',
              'status' => 'required',
           ]);
           $subscription = Subscription::findorfail($id);
           $data = $request->all();

           $subscription->update($data);        
        } 
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => 'unsuccessful',
                'error' => $e->getMessage(),
            ]);
        }
    return response()->json([
        'message' => 'User updated succesfully',
        'error' => 'no',
        'Api_result' => $subscription,
     ]);

    }

    public function destroy($id){
        $subscription = Subscription::findorfail($id);
        $package->destroy($id);
        return response()->json([
            'message' => 'Subscription Deleted succesfully'
        ]);
        // return redirect('admin.package.index')->withType('danger')->withMessage('Company Deleted successfully');
    }


    // public function show_all_subscriptions()
    // {
    //     $subscriptions = Subscription::all();
    //     // return response()->json($subscriptions);
    //     return view('admin.package.index', compact('subscriptions'));
    // }
}