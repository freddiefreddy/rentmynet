<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\User;


class AdminController extends Controller
{

    public function settings(){
    	return view('admin.settings');
    }

    public function profile(){
        $users = User::orderBy('id', 'DESC')->paginate(10);
    	return view('admin.profile', compact('users'));
    }

   
    public function createUser(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        return redirect('profile')->withType('success')->withMessage('User Added');
    }

    public function updatePassword(Request $request){        
        $this->validate($request, [
            'uname' => 'required|string|max:255',
            'uemail' => 'required|string|email|max:255',
            'upassword' => 'required|string|min:6|confirmed',
        ]);

        $id = \Auth::user()->id;
        $user = User::findorfail($id);

        $data = array();
        $data['name'] = $request['uname'];
        $data['email'] = $request['uemail'];
        $data['password'] = bcrypt($request['upassword']);
        
        $user->update($data);        
        return redirect('profile')->withType('success')->withMessage('Profile Updated');
    }

    public function deleteUser(Request $request){
        $data = $request->all();
        $user = User::findorfail($data['user_id']);
        $user->destroy($data['user_id']);
        return redirect('profile')->withType('danger')->withMessage('User Deleted');
    }


}
