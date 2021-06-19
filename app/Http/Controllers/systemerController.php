<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use DB;

use App\SystemUser;


class SystemUserController extends Controller
{
    public function all()
    {
        $system_users = SystemUser::all();
        return response()->json($system_users);
    }

    public function login(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];

        if(!empty(DB::select("select * from system_users where email = '$email' and password = '$password'"))){
            $user = DB::select("select * from system_users where email = '$email' and password = '$password'");

            return response()->json([
                'message' => 'Successfully logged in',
                'boolean' => 'true',
                'system_user' => $user
            ]);
        } 
        else{
            return response()->json([
                'message' => 'Invalid Username or Password',
                'boolean' => 'false',
                'system_user' => 'null'
            ]);
        }
    }

//     public function store(Request $request){
//     try{
//         $data = $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'phone_number' => ['required', 'numeric', 'unique:system_users'],
//             'email' => ['required', 'unique:system_users'],
//             'type' => ['required', 'string', 'max:255'],
//             'password' => ['required', 'string', 'min:8', 'confirmed'],
//         ]);

//         $token = getenv("TWILIO_AUTH_TOKEN");
//         $twilio_sid = getenv("TWILIO_SID");
//         $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

//         $twilio = new Client($twilio_sid, $token);

//         $twilio->verify->v2->services($twilio_verify_sid)
//         ->verifications
//         ->create($data['phone_number'], "sms");

//    $system_user = SystemUser::create([
//                     'name' => $data['name'],
//                     'phone_number' => $data['phone_number'],
//                     'email' => $data['email'],
//                     'type' => $data['type'],
//                     'password' => Hash::make($data['password']),
//                   ]);

//         // $accountid = config('app.twilio.account_sid');
//         // $token = config('app.twilio.auth_token');
//         // try{
//         //     $request->validate([
//         //         'name' => 'required',
//         //         'phone' => 'required',
//         //         'email' => 'required',
//         //         'password' => 'required',
//         //         'type' => 'required',        
//         //     ]);
//         //     $system_user = SystemUser::create($request->all());
//         //     $code = rand(1000, 9999);
//         //        $client = new Client(['auth' => [$accountid, $token]]);
//         //        $result = $client->post('https://api.twilio.com/2010-04-01/accounts'.$accountid.'Messages/json',
//         //           ['formparams' => [
//         //               'Body'=> 'CODE'.$code,
//         //               'To' => $request->phone,
//         //               'From' => $twilioNumber //Twilio number
//         //             ]
//         //           ]
//         //         );

//         }
//         catch(\Exception $e){
//             echo "Error".$e->getMessage();
//             return response()->json([
//                 'message' => 'unsuccessful',
//                 'error' => $e->getMessage(),
//             ]);
//             $system_user->delete();
//         }
//     return response()->json([
//         'message' => 'New System user has been created',
//         'system_user' => $system_user,
//         'otp' => $code

//         // codeline
//     ]);
//     }



public function store(Request $request){
    $token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_sid = getenv("TWILIO_SID");
    $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    try{
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'unique:system_users'],
            'email' => ['required', 'unique:system_users'],
            'type' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);



        $twilio = new Client($twilio_sid, $token);

        $twilio->verify->v2->services($twilio_verify_sid)
        ->verifications
        ->create($data['phone_number'], "sms");

   $system_user = SystemUser::create([
                    'name' => $data['name'],
                    'phone_number' => $data['phone_number'],
                    'email' => $data['email'],
                    'type' => $data['type'],
                    'password' => Hash::make($data['password']),
                  ]);

        // $accountid = config('app.twilio.account_sid');
        // $token = config('app.twilio.auth_token');
        // try{
        //     $request->validate([
        //         'name' => 'required',
        //         'phone' => 'required',
        //         'email' => 'required',
        //         'password' => 'required',
        //         'type' => 'required',        
        //     ]);
        //     $system_user = SystemUser::create($request->all());
        //     $code = rand(1000, 9999);
        //        $client = new Client(['auth' => [$accountid, $token]]);
        //        $result = $client->post('https://api.twilio.com/2010-04-01/accounts'.$accountid.'Messages/json',
        //           ['formparams' => [
        //               'Body'=> 'CODE'.$code,
        //               'To' => $request->phone,
        //               'From' => $twilioNumber //Twilio number
        //             ]
        //           ]
        //         );

        }
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => 'unsuccessful',
                'error' => $e->getMessage(),
            ]);
            $system_user->delete();
        }
    return response()->json([
        'message' => 'New System user has been created',
        'system_user' => $system_user,
        'otp' => $code

        // codeline
    ]);
    }
    public function verify(Request $request)
    {
    try{
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);

        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

        $twilio = new Client($twilio_sid, $token);

        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verification_code'], array('to' => $data['phone_number']));

        if ($verification->valid) {
            $system_user = tap(SystemUser::where('phone_number', $data['phone_number']))->update(['phone_verified_at' => true]);
            /* Authenticate user */
            Auth::login($system_user->first());
            // return redirect()->route('home')->with(['message' => 'Phone number verified']);
        }
    }
    catch(\Exception $e){
        echo "Error".$e->getMessage();
        return response()->json([
            'message' => 'Invalid verification code entered!',
            'error' => $e->getMessage(),
        ]);
        echo $e->getMessage();
    }

    return response()->json([
        'message' => 'Phone number verified',
        'system_user' => $data,
        'otp' => $code
    
            // codeline
        ]);
        // return back()->with(['phone_number' => $data['phone_number'], 'error' => 'Invalid verification code entered!']);
    }

    

    public function all_users()
    {
        $system_users = SystemUser::all();
        return view('admin.systemuser.index', compact('system_users'));
    }

    public function show_admin_users_all(){
        $admin_users= SystemUser::where('type','user')->orderBy('id')->paginate(10);
        return view('admin.systemuser.user.index', compact('admin_users'));
    }

    public function show_admin_vendors_all(){
        $admin_vendors= SystemUser::where('type','vendor')->orderBy('id')->paginate(10);
        // return response()->json($admin_vendors);
        return view('admin.systemuser.vendor.index', compact('admin_vendors'));

    }



    // public function verified($system_user){

    // }



    public function update(Request $request, $id)
    {
        try{
            $request->validate( [
              'name' => 'required',
              'phone' => 'required',
              'email' => 'required',
              'password' => 'required',
           ]);
           $system_user = System_user::findorfail($id);
           $data = $request->all();

           $system_user->update($data);        
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
        'system_user' => $system_user,
     ]);

    // return redirect('systemuser')->withType('success')->withMessage('User Updated');
    }

    public function show($id)
    {   
        $system_user = SystemUser::findorfail($id);
        return view('systemuser.show', compact('system_user'));
    }
    // public function update($system_user){

    // }

        // public function show($system_user){

    // }

    public function destroy($id){
        $user = SystemUser::findorfail($id);
        $user->destroy($id);
        // return response()->json([
        //     'message' => 'User Deleted succesfully'
        // ]);
        return redirect('systemuser')->withType('danger')->withMessage('User Deleted');

    }

    // public function deleteUser(Request $request){
    //     $data = $request->all();
    //     $user = SystemUser::findorfail($data['id']);
    //     $user->destroy($data['id']);
    //     return redirect('admin/profile')->withType('danger')->withMessage('User Deleted');
    // }

     



}