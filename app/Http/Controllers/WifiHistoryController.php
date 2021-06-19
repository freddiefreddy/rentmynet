<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\WifiHistory;


class WifiHistoryController extends Controller
{
    // public function all()
    // {
    //     $wifi_histories = wifi_history::all();
    //     return response()->json($wifi_histories);
    // }

    public function connection(Request $request)
    {
        try{
            $request->validate([
                'wi_id' => 'required', 
                'uid' => 'required'    
            ]);
            $wifi_history = WifiHistory::create($request->all());
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
        'message' => ' Router Connected Successfully',
        'error' => 'no',
        'Api_result' => $wifi_history
        // Add the remaining code part
    ]);
    }

    public function disconnection(Request $request){
        try{
            $data = $request->input();

            $item = WifiHistory::where('id',$data['id'])->first();
            $date = date('Y-m-d H:i:s');

            $to_time = strtotime($date);
            $from_time = strtotime($item['created_at']);

           echo $timeDifference = Carbon::parse(($item['created_at']))->diffInMinutes(Carbon::parse($date));

           echo $earn = $timeDifference*5;
              WifiHistory::where('id',$data['id'])->update(['time_used' => $timeDifference, 'rent' => $earn]);
              $item =WifiHistory::where('id',$data['id'])->first();
        }

        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => 'Unable to connect !',
                'error' => $e->getMessage(),
            ]);
            echo $e->getMessage();
        }
    return response()->json([
        'message' => ' Router Connected Successfully',
        'error' => 'no',
        // 'Api_result' => $wifi_history
        'Api_result'=> $data
        // Add the remaining code part
    ]);

    }

}