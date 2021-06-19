<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use DB;
use App\WifiInfo;


class WifiInfoController extends Controller
{
    public function all()
    {
        $wifi_infos =WifiInfo::all();
        return response()->json($wifi_infos);
    }

    public function add_router(Request $request)
    {
        try{
            $request->validate([
                'SSID' => 'required',
                'BSSID' => 'required',
                'password' => 'required',
                'link_speed' => 'required',
                'up_speed' => 'required', 
                'down_speed'  => 'required', 
                'vuid' => 'required'    
            ]);
            $wifi_info = WifiInfo::create($request->all());
        }
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => 'An error in adding router',
                'error' => $e->getMessage(),
            ]);
            echo $e->getMessage();
        }
    return response()->json([
        'message' => 'New Router Added successfully',
        'error' => 'no',
        'Api_result' => $wifi_info

        // Add the remaining code part
    ]);
    }

    public function show_admin_routers_all()
    {
        $wifi_infos = Wifiinfo::all();
        
        return view('admin.router.index', compact('wifi_infos'));     
    }

    // public function show_connected(){

    // }

    public function destroy($id){
        $wifi_info = WifiInfo::findorfail($id);
        $wifi_info->destroy($id);
        // return response()->json([
        //     'message' => 'Router Deleted succesfully'
        // ]);
        return redirect('admin/router.index')->withType('danger')->withMessage('Router Deleted Successfully');

    }

}