<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login','AuthController@authenticate');
	Route::get('/login','AuthController@authenticate');
	
    Route::post('/logout','AuthController@logout');
    Route::post('/check','AuthController@check');
    Route::post('/register','AuthController@register');
	Route::get('/register','AuthController@register');
    Route::get('/activate/{token}','AuthController@activate');
    Route::post('/password','AuthController@password');
    Route::post('/validate-password-reset','AuthController@validatePasswordReset');
    Route::post('/reset','AuthController@reset');
    Route::post('/social/token','SocialAuthController@getToken');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/charity', function (Request $request) {
    return $request->charity();

});
 Route::post('/user/update-avatar','SellerproductController@updateAvatar');
Route::resource('/gs_seller_organisation', 'SellerController');
Route::resource('/gs_seller_product', 'SellerproductController');
Route::get('/user','UserController@index');

Route::get('/sellersearch', 'SellerController@search');
Route::post('/sellersearch', 'SellerController@search');
Route::post('/upload', function (Request $request) {
    
        $imageData = $request->get('image');
        $fileName = uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/').$fileName);
        return response()->json(['fileName'=>$fileName,'error'=>false]);

});
