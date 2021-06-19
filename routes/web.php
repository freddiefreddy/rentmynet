<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {return view('welcome');});


Route::namespace('Auth')->group(function () {

    // Route::get('/login', function(){return view('auth.login');})->name('login');
    // Route::post('/login', 'LoginController@login');
    // Route::get('/register', function () {return view('auth.register');})->name('register');


      



    // Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
    // Route::post('/register', 'RegisterController@register');

    // Route::get('/verify', 'VerificationController@show');
    // Route::post('/verify', 'VerificationController@verify');
    // Route::post('/resend', 'VerificationController@resend');

    Route::get('/logout', 'LoginController@logout');
});



Route::resource('wifi_info', 'WifiInfoController');
// Route::view('/', 'secrets')->middleware('auth')->middleware('verified');

Route::get('/verify', function () {return view('auth.verify');})->name('verify');
// Route::post('/register', 'AuthController@create')->name('register');
Route::post('/verify', 'AuthController@verify')->name('auverify');

Route::get('/dashboard', 'DashboardController@listing')->name('dashboard');

 // System Users
 Route::get('/listusersadmin', 'SystemUserController@show_admin_users_all')->name('listusersadmin');
 Route::get('/listusersvendor', 'SystemUserController@show_admin_vendors_all')->name('listusersvendor');

 Route::get('/setting', 'AdminController@settings')->name('setting');    
 Route::get('/profile', 'AdminController@profile')->name('profile');

 Route::post('deleteUser', 'AdminController@deleteUser')->name('deleteUser');
 Route::post('createUser', 'AdminController@createUser')->name('createUser');
 Route::post('updatePassword', 'AdminController@updatePassword')->name('updatePassword');

 //Wifi Information
 Route::get('/listrouters', 'WifiInfoController@show_admin_routers_all')->name('listrouters');

//  Route::get('/home', 'HomeController@index')->name('home');




// Route::get('/list_routers_admin_connected', 'WifiController@show_connected')->name('list connected routers');

//Package Information
Route::get('/listpackages','PackageDetailController@show_packages')->name('listpackages');
Route::post('/package_create',['uses'=>'PackageDetailController@create']);

Route::get('/redeemcards', 'RedeemCardController@show_cards_all')->name('redeemcards');
Route::get('/transactions', 'VendorTransactionController@all_transactions')->name('transactions');
Route::get('/companies','AddController@all')->name('companies');

//Add Information
// Route::get('/list_adds_admin','AddController@show_admin_adds_all')->name('list packages');

Route::post('/add_post',['uses'=>'AddController@create']);







//APIS
Route::get('/system_users','SystemUserController@all')->name('system_users.all');
Route::post('/add_system_users',['uses'=>'SystemUserController@create']);
Route::get('/system_users/login','SystemUserController@login')->name('system_users.login');
Route::delete('/system_users/delete/{id}','SystemUserController@destroy')->name('system_users.destroy');
Route::get('/system_users/{id}','SystemUserController@show')->name('system_users.show');
Route::put('/system_users/update/{id}','SystemUserController@update')->name('system_users.update');

Route::get('/system_users/showusers','SystemUserController@show_admin_users_all')->name('system_users.showusers');
Route::get('/system_users/showvendors','SystemUserController@show_admin_vendors_all')->name('system_users.showvendors');


//Route::get('/system_users/verified/{system_user}','SystemUserController@verified')->name('system_users.verified');
// Route::get('/system_users{system_user}','SystemUserController@show')->name('system_users.show');
// Route::put('/system_users/{system_user}','SystemUserController@update')->name('system_users.update');
// Route::delete('/system_users{system_user}','SystemUserController@destroy')->name('system_users.destroy');


Route::get('/list_routers','WifiInfoController@all')->name('list all routers');
Route::post('/add_routers',['uses'=>'WifiInfoController@add_router']);

// Route::get('/send_otp',);

Route::post('send_otp',['uses'=>'SystemUserController@send_otp']);
//post phone number

Route::post('/add_sub',['uses'=>'SubscriptionController@add_subscriber']);
//Redeem card is linked to the subscription by the code number
//we post the card code, status which should be paid and the user id of the specific card

Route::get('/connect','WifiHistoryController@connection')->name('connect wifi');
Route::get('/disconnect','WifiHistoryController@disconnection')->name('Disconnect wifi');
Route::get('/router/password','WifiInfoController@router_password')->name('show router password');
Route::get('/account_detail/{id}', 'AccountController@account_info')->name('account details');//contains the earn and withdraw

//done
Route::get('/my_package', 'PackageDetailController@package_info')->name('package details'); 
//get the package price and the timespan

//done
Route::get('/transaction_details', 'VendorTransactionController@transaction_info')->name('transaction details'); 
//contains status it should be pending or approved and the amount

//done
Route::post('/add_payment_request', ['uses'=>'VendorTransactionController@payment_request']);
//contains acc number, ammount from the specific person

Route::post('/router_users', 'WifiInfoController@router_user');
//post the BSSID
//check this one carefi;;u

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


// Route::get('/', function () {return view('auth.register');})->name('register');
// Route::get('/register', function () {return view('auth.register');})->name('register');
// Route::get('/dashboard', 'DashboardController@listing')->name('dashboard');