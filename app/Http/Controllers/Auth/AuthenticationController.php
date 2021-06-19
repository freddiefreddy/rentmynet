<?php



namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\SystemUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;

class AuthenticationController extends Controller
{

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'numeric', 'unique:system_users'],
                'email' => ['required', 'unique:system_users'],
                'type' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    
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

        return redirect()->route('verify')->with(['phone_number' => $data['phone_number']]);
    }

    protected function verify(Request $request)
    {
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
            Auth::login($sytsem_user->first());
            return redirect()->route('dashboard')->with(['message' => 'Phone number verified']);
        }
        return back()->with(['phone_number' => $data['phone_number'], 'error' => 'Invalid verification code entered!']);
    }

}

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Verify\Service;
// use Illuminate\Foundation\Auth\RedirectsUsers;
// use Illuminate\Support\MessageBag;
// use Illuminate\Http\Request;


// class VerificationController extends Controller
// {

//     use RedirectsUsers;

//     /**
//      * Where to redirect users after verification.
//      *
//      * @var string
//      */
//     protected $redirectTo = '/';


//     /**
//      * Verification service
//      *
//      * @var Service
//      */
//     protected $verify;

//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct(Service $verify)
//     {
//         $this->verify = $verify;

//         $this->middleware('auth');
// //        $this->middleware('signed')->only('verify');
// //        $this->middleware('throttle:6,1')->only('verify', 'resend');
//     }

//     /**
//      * Show the phone verification form.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function show(Request $request)
//     {
//         return $request->user()->hasVerifiedPhone()
//             ? redirect($this->redirectPath())
//             : view('auth.verify');
//     }

//     /**
//      * Mark the authenticated user's phone number as verified.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      * @throws \Illuminate\Auth\Access\AuthorizationException
//      */
//     public function verify(Request $request)
//     {
//         if ($request->user()->hasVerifiedPhone()) {
//             return redirect($this->redirectPath());
//         }

//         $code = $request->post('code');
//         $phone = $request->user()->phone_number;

//         $verification = $this->verify->checkVerification($phone, $code);

//         if ($verification->isValid()) {
//             $request->user()->markPhoneAsVerified();
//             return redirect($this->redirectPath());
//         }

//         $errors = new MessageBag();
//         foreach ($verification->getErrors() as $error) {
//             $errors->add('verification', $error);
//         }

//         return view('auth.verify')->withErrors($errors);
//     }

//     /**
//      * Resend the email verification notification.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function resend(Request $request)
//     {
//         if ($request->user()->hasVerifiedPhone()) {
//             return redirect($this->redirectPath());
//         }

//         $phone = $request->user()->phone_number;
//         $channel = $request->post('channel', 'sms');
//         $verification = $this->verify->startVerification($phone, $channel);

//         if (!$verification->isValid()) {

//             $errors = new MessageBag();
//             foreach($verification->getErrors() as $error) {
//                 $errors->add('verification', $error);
//             }

//             return redirect('/verify')->withErrors($errors);
//         }

//         $messages = new MessageBag();
//         $messages->add('verification', "Another code sent to {$request->user()->phone_number}");

//         return redirect('/verify')->with('messages', $messages);
//     }
// }







