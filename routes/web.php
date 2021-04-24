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

//['register' => false]
Auth::routes();

Route::group(['middleware' => 'active'] , function(){

Route::get('/home', 'HomeController@index')->name('home');

/*start log out route*/
Route::get('/logout', function(){
	Auth::guard('web')->logout();
	return redirect('login');
})->name('logout_admin');


Route::resource('admin/invoice' , 'invoice');
Route::resource('admin/section' , 'section');
Route::resource('admin/products' , 'product');


Route::resource('admin/roles','RoleController');
Route::resource('admin/users','UserController');

Route::get('admin/notify' , function(){
	//\auth()->user()->unreadNotifications->markAsRead();
	return auth()->user()->unreadNotifications->count() ;
});

Route::get('admin/readNotify' , function(){
	\auth()->user()->unreadNotifications->markAsRead();
	return auth()->user()->unreadNotifications->count() ;
});

//start language 
Route::get('admin/{lang}' , function($lang){
	session()->put('lang' , $lang) ;
	return back();
});
Route::get('/{icons}', function($page){
	return view('admin.'.$page);
});


});










