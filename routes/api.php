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
Route::post('/charityregister','AuthController@charityregister');
Route::get('/register','AuthController@register');
Route::get('/activate/{token}','AuthController@activate');
Route::post('/password','AuthController@password');
Route::post('/validate-password-reset','AuthController@validatePasswordReset');
Route::post('/reset','AuthController@reset');
Route::post('/social/token','SocialAuthController@getToken');
Route::post('/selectrole','UserController@role');
});

Route::group(['middleware' => ['jwt.auth']], function () {
	
//user Profile
Route::get('/auth/user','AuthController@getAuthUser');
Route::post('/user/update-profile','UserController@updateProfile');
Route::post('/user/update-avatar','UserController@updateAvatar');
Route::post('/user/remove-avatar','UserController@removeAvatar');
Route::get('/get_user','UserController@index');
Route::post('/user/change-password','AuthController@changePassword');



//seller Product
Route::delete('/task/{id}','SellerproductController@destroy');
Route::post('/task/{id}','SellerproductController@update');
Route::get('/task/{id}','SellerproductController@edit');
Route::get('/product_list','SellerproductController@index');
Route::post('product/update-avatar','SellerproductController@updateAvatar');
Route::post('product/remove-avatar','SellrproductController@removeAvatar');
Route::resource('/gs_seller_product', 'SellerproductController');
Route:: post('/gs_seller_product', 'SellerproductController@store');


//Seller Organisation
Route::resource('/gs_seller_organisation', 'SellerController');
Route::get('/gs_seller_organisation', 'SellerController@index');
Route::get('/seller_list','SellerController@seller_list');
Route::get('/edit_seller/{id}','SellerController@edit');
Route::post('/edit_seller/{id}','SellerController@update');
Route::post('/update-seller/{id}','SellerController@updateSeller' );
Route::delete('/seller_list/{id}','SellerController@destroy');
Route::get('/vender_category','SellerCategoryController@index');
Route::post('/vender_category','SellerCategoryController@store');

//Charity Ads
Route::post('/create_ads','AdsController@store');
Route::get('/charityads/','AdsController@index');
Route :: get('/charityads/{id}','AdsController@edit');
Route::delete('/charityads/{id}','AdsController@destroy');
Route :: post('/charityads/{id}','AdsController@update');
Route::post('/update-avatar/{id}','AdsController@updateAvatar' );
Route::post('/update-image','AdsController@updateImage' );

//Charity organisation
Route::get('/charity_organisation','charityController@index');
Route::post('/charity_category','CharityCategoryController@store');
Route::get('/charity_category','CharityCategoryController@index');
Route::get('/charity_list','charityController@charity_list');
Route::get('/edit_charity/{id}','charityController@edit');
Route::post('/update-charity/{id}','charityController@updateCharity' );
Route::post('/edit_charity/{id}','charityController@update');
Route::delete('/charity_list/{id}','charityController@destroy');
Route::resource('/gs_charity_organisation', 'charityController');

});


//Route::get('/product/search', 'ProductController@getSearchPage');
Route::get('/product/search','ProductController@formsearch');
Route::post('/product/search', 'ProductController@formSearch');
Route::get('/product_details/{id}','SellerproductController@product_details');
Route::get('/productsearch','SellerproductController@products');
Route::post('/productsearch','SellerproductController@search');

//charity list
Route::get('/charity_details/{id}','charityController@charity_details');
Route::post('/search','charityController@search');
Route::get('/search','charityController@search');


//message part
Route::get('/create_message','MessageController@index');
Route::post('/create_message','MessageController@store');
Route::get('/get_user','UserController@index');