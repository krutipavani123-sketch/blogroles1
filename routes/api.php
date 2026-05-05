    <?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\apicontroller;
    use App\Http\Controllers\logincontroller;
    use  App\Http\Controllers\usertokencontroller;
    use  App\Http\Controllers\bloglistcontroller;


    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::get('user', [apicontroller::class, 'alluser']);

    Route::get('user/{id}', [apicontroller::class, 'singleuser']);

    //  Route::get('search', [usertokencontroller::class, 'search']);

    Route::post('register', [usertokencontroller::class, 'register']);
    Route::post('login', [usertokencontroller::class, 'loginapi']);



    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::get('bloglist', [usertokencontroller::class, 'bloglist']);

        Route::get('deleteblog/{id}', [usertokencontroller::class, 'deleteblog']);

        Route::post('addblog', [usertokencontroller::class, 'addblog']);


        Route::get('updateblog/{id}', [usertokencontroller::class, 'updateblog']);
        Route::get('search', [usertokencontroller::class, 'search']);
        Route::get('filter', [usertokencontroller::class, 'filter']);

        Route::get('sort', [usertokencontroller::class, 'sort']);
    });





    






















    // Route::post('updateblog', [usertokencontroller::class, 'updateblog']);

    // Route::get('editblog', [usertokencontroller::class, 'editblog']);
    // Route::post('editblog', [usertokencontroller::class, 'editblog']);


    //Route::post('login', [logincontroller::class, 'login']);
    // Route::group(['middleware' => 'auth:sanctum'], function () {
    //     Route::get('delete/{id}', [bloglistcontroller::class, 'delete']);

    //     Route::get('list', [bloglistcontroller::class, 'list']);
    //     Route::get('edit/{id}', [bloglistcontroller::class, 'edit']);
    //     Route::put('edit/{id}', [bloglistcontroller::class, 'update']);
    //     Route::get('search', [bloglistcontroller::class, 'search']);
    // });
