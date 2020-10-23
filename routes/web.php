<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sendMail', function () {
    //return view('welcome');

    $to_name="Miguel";
    $to_email="mcamacho3@ucol.mx";
    $data=array("name"=>"Peter Parker", "body"=>"Test mail");
    
    Mail::send('mail', $data, function($message) use ($to_name, $to_email){
        $message->to($to_email)
        ->subject('Lara mail subject');
    });
});
