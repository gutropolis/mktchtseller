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
Route::group(['middleware' => ['jwt.auth']], function () {
 //user Profile
Route::get('/auth/user','AuthController@getAuthUser');
Route::post('/user/update-profile','UserController@updateProfile');
Route::get('/get_user','UserController@index');
Route::post('/user/change-password','AuthController@changePassword');
//seller Product
Route::delete('/task/{id}','SellerproductController@destroy');
Route::post('/task/{id}','SellerproductController@update');
Route::get('/task/{id}','SellerproductController@edit');
Route::get('/product_list','SellerproductController@index');
Route::post('/user/update-avatar','SellerproductController@updateAvatar');
//Seller Organisation
Route::resource('/gs_seller_organisation', 'SellerController');
Route::get('/gs_seller_organisation', 'SellerController@index');
Route::get('/seller_list','SellerController@seller_list');
Route::get('/edit_seller/{id}','SellerController@edit');
Route::post('/edit_seller/{id}','SellerController@update');
 Route::delete('/seller_list/{id}','SellerController@destroy');
 Route::get('/seller_details/{id}','SellerController@seller_details');

Route::get('/vender_category','SellerCategoryController@index');
Route::post('/vender_category','SellerCategoryController@store');
Route::post('/create_ads','AdsController@store');
Route::get('/get_ads/','AdsController@index');
Route :: get('/get_ad/{id}','AdsController@edit');
Route :: post('/get_ad/{id}','AdsController@update');
Route::resource('/gs_seller_product', 'SellerproductController');
Route::get('/sellersearch', 'SellerController@search');
Route::post('/sellersearch', 'SellerController@search');

//message communicate
Route::post('/create_message','MessageController@store');

});


Route::post('/upload', function (Request $request) {
    
        $imageData = $request->get('image');
        $fileName = uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/').$fileName);
        return response()->json(['fileName'=>$fileName,'error'=>false]);

});

Route::resource('/gs_charity_organisation', 'charityController');


Route::post('/upload', function (Request $request) {
   $imageData = $request->get('image');
      $fileName = uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/').$fileName);
        return response()->json(['fileName'=>$fileName,'error'=>false]); 
    
});

//Charity Organisation 
Route::get('/charity_details/{id}','charityController@charity_details');

Route::post('/search','charityController@search');
Route::get('/search','charityController@search');
Route::post('/search','charityController@search');
Route::get('/charity_organisation','charityController@index');
Route::post('/charity_category','CharityCategoryController@store');
Route::get('/charity_category','CharityCategoryController@index');
Route::get('/charity_list','charityController@charity_list');
Route::get('/edit_charity/{id}','charityController@edit');
Route::post('/edit_charity/{id}','charityController@update');
 Route::delete('/charity_list/{id}','charityController@destroy');
//Route::resource('/edit_charity', 'charityController');

Route::get('/search','charityController@search');
Route::post('/search','charityController@search');