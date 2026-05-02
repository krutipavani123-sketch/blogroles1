<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\welcomecontroller;
use App\Http\Controllers\bloglistcontroller;
use App\Http\Controllers\editcontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\loginmailcontroller;
use App\Http\Controllers\fetchalluserdata;

use PHPUnit\Metadata\RequiresPhpunitExtension;

Route::get('loginapi', [logincontroller::class, 'loginapi']);

Route::view('add-blog', 'welcome');
Route::get('welcome', [bloglistcontroller::class, 'list']);
Route::post('bloglist', [bloglistcontroller::class, 'bloglist']);


//Route::view('/', 'register');
Route::view('login', 'login');
//  Route::view('welcome','welcome');
//Route::post('register', [logincontroller::class, 'register']);

Route::post('login', [logincontroller::class, 'login']);
Route::get('welcome', [bloglistcontroller::class, 'list']);
//Route::post('', [bloglistcontroller::class, '']);



Route::get('delete/{id}', [bloglistcontroller::class, 'delete']);

Route::get('list', [bloglistcontroller::class, 'list']);
Route::get('edit/{id}', [bloglistcontroller::class, 'edit']);
Route::put('edit/{id}', [bloglistcontroller::class, 'update']);
Route::get('search', [bloglistcontroller::class, 'search']);

Route::get('datalist', [fetchalluserdata::class, 'datalist']);

// Route::get('welcome', function () {
//     return view('welcome');
// });

// To show the form


Route::post('mail', [loginmailcontroller::class, 'loginmail']);
Route::view('send-mail', 'sendmail');


//Route::post('login', [logincontroller::class, 'login']);

// To handle the form submission

Route::get('addblog', [bloglistcontroller::class, 'addblog']);
Route::post('addblog', [bloglistcontroller::class, 'addblog']);



// Route::post('login', [logincontroller::class, 'login']);
// Route::post('welcome', [bloglistcontroller::class, 'list']);
//Route::get('welcome', [welcomecontroller::class, 'addblog']);
/*Route::post('bloglist', [bloglistcontroller::class, 'bloglist']);
Route::get('list', [bloglistcontroller::class, 'list']);

Route::get('delete/{id}', [bloglistcontroller::class, 'delete']);


Route::get('edit/{id}', [bloglistcontroller::class, 'edit']);
Route::put('edit/{id}', [bloglistcontroller::class, 'update']);

Route::view('/', 'login');
Route::post('/', [logincontroller::class, 'login']);
Route::post('welcome', [bloglistcontroller::class, 'list']);

Route::view('welcome', 'welcome');

Route::get('search', [bloglistcontroller::class, 'search']);

//Route::view('welcome', 'welcome');

//Route::post('', [logincontroller::class, 'login']);*/
