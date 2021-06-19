<!-- @extends('base')

@section('title', 'Log In')
@section('header')
  <h1>Log In</h1>
@endsection

@section('content')
  <form method="post">
    @csrf
    <label for="name">Username</label>
    <input name="name" id="username" required>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Log In">
  </form>
@endsection -->




/**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'name';
    }


    // public function login(Request $request)
    // {
    //     $email = $request['email'];
    //     $password = $request['password'];

    //     if(!empty(DB::select("select * from system_users where email = '$email' and password = '$password'"))){
    //         $user = DB::select("select * from system_users where email = '$email' and password = '$password'");

    //         return response()->json([
    //             'message' => 'Successfully logged in',
    //             'boolean' => 'true',
    //             'system_user' => $user
    //         ]);
    //     } 
    //     else{
    //         return response()->json([
    //             'message' => 'Invalid Username or Password',
    //             'boolean' => 'false',
    //             'system_user' => 'null'
    //         ]);
    //     }
    // }