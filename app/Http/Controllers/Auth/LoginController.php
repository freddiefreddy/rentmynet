<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

//use App\SystemUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    //Route::get('/home', 'HomeController@index')->name('home');

    public function loginWithGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function loginWithFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver('google')->stateless()->user();

            $locateUser = User::where('google_id', $user->getEmail())->first();

            if ($locateUser) {
                $newUser = User::where('email', $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);

                $newUser = User::where('email', $user->getEmail())->first();
            }
            else{
                $newUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],
                [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId()),
                ]
            );

            }

            Auth::loginUsingId($newUser->id);
            return redirect()->route('dashboard');
        }
         catch (\Throwable $th) {
            return $th;
        }
    }

    public function handleFacebookCallback(){
        try {
            
            $user = Socialite::driver('facebook')->stateless()->user();

            $newUser = User::updateOrCreate([
                'facebook_id' => $user->getId(),
            ],
            [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' =>Hash::make($user->getName().'@'.$user->getId())
            ]);

            Auth::loginUsingId($newUser->id);
            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            return $th;
        }
    }
  

}
