<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\welcomecontroller;
use App\Http\Controllers\bloglistcontroller;
use App\Http\Controllers\editcontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\loginmailcontroller;
use App\Http\Controllers\fetchalluserdata;
use App\Http\Controllers\relationcontroller;
use App\Http\Controllers\imgcontroller;
use App\Http\Controllers\profilecontroller;
use App\Http\Controllers\logoutcontroller;
use App\Http\Controllers\rolecontroller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\usercontroller;
use Fruitcake\LaravelDebugbar\Facades\Debugbar;
use PHPUnit\Metadata\RequiresPhpunitExtension;
use App\Http\Controllers\bloglist1controller;

Route::get('welcome', function () {
    Debugbar::info('INFO');
    Debugbar::error('INFO');
    Debugbar::warning('INFO');
    Debugbar::addMessage('INFO');
    Debugbar::startMeasure('Hello', 'Rendering msg');
    try {
        throw new Exception('Test Exception Debugbar');
    } catch (Exception $e) {
        Debugbar::addThrowable($e);
    }
    $name = 'debugger';


    return view('welcome', ['name' => $name]);
});

Route::middleware(['auth'])->group(function () {

    Route::get('list', [bloglistcontroller::class, 'list']);
    //   Route::get('welcome', [bloglistcontroller::class, 'list']);

    Route::get('profile', [profilecontroller::class, 'profile']);
    Route::get('logout', [logoutcontroller::class, 'logout']);

    Route::middleware(['permission:update task'])->group(function () {
        Route::get('edit/{id}', [bloglistcontroller::class, 'edit']);
        Route::put('update/{id}', [bloglistcontroller::class, 'update']);
    });

    Route::middleware(['permission:delete task'])->group(function () {
        Route::get('delete/{id}', [bloglistcontroller::class, 'delete']);
    });

    Route::middleware(['permission:create task'])->group(function () {
        Route::get('add-blog', fn() => view('addblog'));
        Route::post('bloglist', [bloglistcontroller::class, 'bloglist']);
    });
    Route::post('export', [bloglistcontroller::class, 'export']);

    // Route::middleware(['permission:manage users'])->group(function () {

    //     Route::get('users/create', [usercontroller::class, 'create'])->name('users.create');
    //     Route::post('users/store', [usercontroller::class, 'store'])->name('users.store');
    //     Route::get('users/list', [usercontroller::class, 'list'])->name('users.list');
    //     Route::get('users/edit/{id}', [usercontroller::class, 'edit'])->name('users.edit');
    //     Route::put('users/update/{id}', [usercontroller::class, 'update'])->name('users.update');
    //     Route::get('users/delete/{id}', [usercontroller::class, 'delete'])->name('users.delete');
    // });


    // Route::middleware(['permission:manage roles'])->group(function () {

    //     Route::get('roles/create', [rolecontroller::class, 'create'])->name('roles.create');
    //     Route::post('roles/store', [rolecontroller::class, 'store'])->name('roles.store');
    //     Route::get('roles/list', [rolecontroller::class, 'list'])->name('roles.list');
    //     Route::get('roles/edit/{id}', [rolecontroller::class, 'edit'])->name('roles.edit');
    //     Route::post('roles/update/{id}', [rolecontroller::class, 'update'])->name('roles.update');
    //     Route::get('roles/delete/{id}', [rolecontroller::class, 'delete'])->name('roles.delete');
    // });
});
Route::get('roles/create', [rolecontroller::class, 'create'])->name('roles.create');
Route::post('roles/store', [rolecontroller::class, 'store'])->name('roles.store');
Route::get('roles/list', [rolecontroller::class, 'list'])->name('roles.list');
Route::get('roles/edit/{id}', [rolecontroller::class, 'edit'])->name('roles.edit');
Route::post('roles/update/{id}', [rolecontroller::class, 'update'])->name('roles.update');

Route::get('roles/delete/{id}', [rolecontroller::class, 'delete'])->name('roles.delete');
Route::view('login', 'login');
Route::post('login', [logincontroller::class, 'login']);

Route::get('loginapi', [logincontroller::class, 'loginapi']);

Route::get('users/create', [usercontroller::class, 'create'])->name('users.create');

Route::post('users/store', [usercontroller::class, 'store'])->name('users.store');

Route::get('users/list', [usercontroller::class, 'list'])->name('users.list');

Route::get('users/edit/{id}', [usercontroller::class, 'edit'])->name('users.edit');

Route::put('users/update/{id}', [usercontroller::class, 'update'])->name('users.update');

Route::get('users/delete/{id}', [usercontroller::class, 'delete'])->name('users.delete');

// Route::middleware(['auth', 'role:admin'])->group(function () {

//     Route::get('add-blog', function () {
//         return view('add-blog');
//     });

//     Route::post('bloglist', [bloglistcontroller::class, 'bloglist']);

//     Route::get('delete/{id}', [bloglistcontroller::class, 'delete']);
//     Route::get('edit/{id}', [bloglistcontroller::class, 'edit']);
//     Route::put('edit/{id}', [bloglistcontroller::class, 'update']);
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('list', [bloglistcontroller::class, 'list']);
// });


// Route::middleware(['auth'])->group(function () {

//     Route::get('welcome', [bloglistcontroller::class, 'list']);
//     Route::get('profile', [profilecontroller::class, 'profile']);
//     Route::get('logout', [logoutcontroller::class, 'logout']);
// });


// Route::view('login', 'login');
// Route::post('login', [logincontroller::class, 'login']);

// Route::get('loginapi', [logincontroller::class, 'loginapi']);


//Route::get('welcome', [bloglistcontroller::class, 'list']);
//Route::post('bloglist', [bloglistcontroller::class, 'bloglist']);

//Route::view('login', 'login');

//Route::get('profile', [profilecontroller::class, 'profile']);
//Route::get('logout', [logoutcontroller::class, 'logout']);


//Route::post('login', [logincontroller::class, 'login']);
//Route::get('welcome', [bloglistcontroller::class, 'list']);

//Route::get('delete/{id}', [bloglistcontroller::class, 'delete']);

Route::get('list', [bloglistcontroller::class, 'list']);
//Route::get('edit/{id}', [bloglistcontroller::class, 'edit']);
//Route::put('edit/{id}', [bloglistcontroller::class, 'update']);
Route::get('search', [bloglistcontroller::class, 'search']);

Route::get('datalist', [fetchalluserdata::class, 'datalist']);


Route::post('mail', [loginmailcontroller::class, 'loginmail']);
Route::view('send-mail', 'sendmail');

// Route::get('addblog', [bloglistcontroller::class, 'addblog']);
// Route::post('addblog', [bloglistcontroller::class, 'addblog']);

Route::get('onelist', [relationcontroller::class, 'onelist']);
Route::get('manylist', [relationcontroller::class, 'manylist']);
Route::get('manytoone', [relationcontroller::class, 'manytoone']);

//Route::view('upload', 'imgview');
//Route::post('upload', [imgcontroller::class, 'img']);

//Route::post('bloglist', [bloglistcontroller::class, 'bloglist']);

//Route::view('/', 'register');
//  Route::view('welcome','welcome');
//Route::post('register', [logincontroller::class, 'register']);

//Route::post('', [bloglistcontroller::class, '']);

// Route::get('welcome', function () {
//     return view('welcome');
// });

// To show the form
//Route::post('login', [logincontroller::class, 'login']);

// To handle the form submission

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

Route::get('view-list', [bloglistcontroller::class, 'viewList']);
Route::get('list-json', [bloglistcontroller::class, 'listJson']);
//Route::get('view-list', [bloglistcontroller::class, 'getname']);



// Route::get('/queue-test', function () {
//     dispatch(function () {
//         \Log::info('Queue working');
//     });

//     return "Dispatched";
// });

// Route::get("list1", [bloglist1controller::class, 'list1']);
// Route::get("list1", [bloglist1controller::class, 'bloglist']);
// Route::get("list1", [bloglist1controller::class, 'list']);
