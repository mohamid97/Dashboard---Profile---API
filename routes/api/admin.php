<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


    Route::get('/debug-token', function (Request $request) {
        return response()->json([
            'headers' => $request->headers->all(),
            'token'   => $request->bearerToken(),
        ]);
    });

// start Auth 
Route::prefix('v1')->middleware('ckeckLang')->group(function () {



    Route::post('login', 'AuthController@login');
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('get-user', 'AuthController@getData');
        Route::post('logout', 'AuthController@logout');
        Route::post('store', 'CrudController@store')->middleware('checkPermision:create');
        Route::post('update', 'CrudController@update')->middleware('checkPermision:update');
        Route::post('delete' , 'CrudController@delete')->middleware('checkPermision:delete');
        Route::post('all' , 'CrudController@all')->middleware('checkPermision:view');
        Route::post('view' , 'CrudController@view')->middleware('checkPermision:view');
        Route::post('gallery/store','CrudController@storeGallery')->middleware('checkPermision:create');
        Route::post('gallery/all','CrudController@viewGallery')->middleware('checkPermision:view');

        // home page 
    Route::get('/home' ,'HomeController@index');
    




    });
    
    

    



    
});