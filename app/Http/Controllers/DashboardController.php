<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SystemUser;
use App\WifiInfo;

class DashboardController extends Controller
{
    //
    public function listing(){
        // $system_users = SystemUser::orderBy('id', 'type')->limit(10)->get();
        // $wifi_infos =  WifiInfo::orderBy('id', 'DESC')->limit(10)->get();
        $total_users = count(SystemUser::all());
        $total_routers = count(WifiInfo::all());
        $total_vendors = SystemUser::where('type', 'vendor')->get()->count();
        $total_normals = SystemUser::where('type', 'user')->get()->count();

    	return view('admin.dashboard', compact('total_users', 'total_routers', 'total_vendors', 'total_normals'));
    }

}
