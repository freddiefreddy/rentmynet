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

    public function send_otp(Request $request){
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio_number = getenv("TWILIO_NUMBER");
    
        try
        {
            $request->validate([
                'phone' => 'required',   
            ]);
    
            $code = rand(1000, 9999); 
            $client = new Client(['auth' => [$twilio_sid, $token]]);
            $result = $client->post('https://api.twilio.com/2010-04-01/Accounts/'.$accountSid.'/Messages.json',
                ['form_params' => [
                    'Body' => 'CODE: '. $request->code, //set message body
                    'To' => $request->phone,
                    'From' => $twilio_number //we get this number from twilio
                ]]
            );
    
        return $result;
        }
    
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
            return response()->json([
                'message' => 'unsuccessful',
                'error' => $e->getMessage(),
            ]);
        }
    
    // return response()->json([
    //     'message' => 'New System user has been created',
    //     // 'system_user' => $system_user,
    //     'otp' => $code
    
        // codeline
    // ]);
     }



    public function store(Request $request)
    {    
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_ACCOUNT_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFICATION_SID");
       try{
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'unique:system_users'],
            'email' => ['required', 'unique:system_users'],
            'type' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $twilio = new Client($twilio_sid, $token);
    
        $twilio->verify->v2->services($twilio_verify_sid)
        ->verifications
        ->create($data['phone'], "sms");
    
        $system_user = SystemUser::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'type' => $data['type'],
            'password' => Hash::make($data['password']),
        ]);
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
    ]);

        // return redirect()->route('verify')->with(['phone' => $data['phone']]);
    }

    public function verify(Request $request)
    {
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone' => ['required', 'string'],
        ]);

        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_ACCOUNT_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFICATION_SID");

        $twilio = new Client($twilio_sid, $token);

        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($data['verification_code'], array('to' => $data['phone']));

        if ($verification->valid) {
            $system_user = tap(SystemUser::where('phone', $data['phone']))->update(['phone_verified_at' => true]);
            /* Authenticate user */
            Auth::login($system_user->first());
            return response()->json([
                'message' => 'Phone number verified',
                'system_user' => $system_user,
                // 'otp' => $code
           ]);
            // return redirect()->route('dashboard')->with(['message' => 'Phone number verified']);
        }
        else{
        echo "Error".$e->getMessage();
        return response()->json([
            'message' => 'Invalid verification code entered!',
            'error' => $e->getMessage(),
        ]);
        echo $e->getMessage();
        }
    // return back()->with(['phone' => $data['phone'], 'error' => 'Invalid verification code entered!']);
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


}