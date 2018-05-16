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
Route::get('/check','AuthController@check');
Route::post('/check','AuthController@check');
Route::get('/login_check','AuthController@login_check');
Route::post('/register','AuthController@register');
Route::post('/charityregister','AuthController@charityregister');
Route::get('/register','AuthController@register');
Route::get('/activate/{token}','AuthController@activate');
Route::get('/activateads/{token}','AdsController@activate');
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
Route:: post('/gs_seller_product', 'SellerproductController@store');
Route::get('/task/{id}','SellerproductController@edit');
Route::post('/task/{id}','SellerproductController@update');
Route::delete('/task/{id}','SellerproductController@destroy');
Route::get('/product_list','SellerproductController@index');
Route::post('product/update-avatar','SellerproductController@updateAvatar');
Route::post('product/remove-avatar','SellerproductController@removeAvatar');

Route::resource('/gs_seller_product', 'SellerproductController');



//Seller Organisation
Route::resource('/gs_seller_organisation', 'SellerController');
Route::post('/vender_category','SellerCategoryController@store');
Route::get('/gs_seller_organisation', 'SellerController@index');
Route::get('/seller_list','SellerController@list_seller');
Route::get('/companies','SellerController@seller_list');

Route::get('/edit_seller/{id}','SellerController@edit');
Route::post('/edit_seller/{id}','SellerController@update');
Route::post('/update-seller_logo/{id}','SellerController@updatelogo' );
Route::post('/update-seller/{id}','SellerController@updateSeller' );
Route::delete('/seller_list/{id}','SellerController@destroy');
Route::get('/vender_category','SellerCategoryController@index');


//Donation Seller
Route::get('/donation/{id}','SellerController@edit_donation');
Route::get('/donation_list','SellerController@donation_list');
Route::post('/edit_donation/{id}','SellerController@updatedonation');
Route::delete('/delete_donation/{id}','SellerController@destroy_donation');

//Charity Ads
Route::post('/create_ads','AdsController@store');
Route::get('/charityads/','AdsController@index');
Route::get('/charities/','AdsController@charity');
Route::get('/requests','AdsController@request_list');


Route :: get('/charityads/{id}','AdsController@edit');
Route::delete('/charityads/{id}','AdsController@destroy');
Route :: post('/charityads/{id}','AdsController@update');
Route::post('/update-avatar/{id}','AdsController@updateAvatar' );
Route::post('/update-image','AdsController@updateImage' );

//Charity organisation
Route::get('/charity_organisation','CharityController@index');
Route::post('/charity_category','CharityCategoryController@store');
Route::get('/charity_category','CharityCategoryController@index');
Route::get('/charity_list','CharityController@charity_list');

Route::get('/edit_charity/{id}','CharityController@edit');
Route::post('/update-charity_logo/{id}','CharityController@updateCharity' );
Route::post('/edit_charity/{id}','CharityController@update');
Route::delete('/charity_list/{id}','CharityController@destroy');
Route::resource('/gs_charity_organisation', 'CharityController');
Route::get('/edit_status/{id}','CharityController@edit_status');
Route::post('/edit_status/{id}','CharityController@update_status');
Route::get('/charity_notification','CharityController@notification');
Route::get('/unread_charity_notification','CharityController@unread_notification');

//Donaters
Route::get('/donaters_list','CharityController@donaters');
Route::post('/status/{id}','CharityController@status');
Route::post('/certify/{id}','CharityController@toggleStatus');
Route::get('/product_name/{id}','CharityController@product_name');

});

//Route::get('/product/search', 'ProductController@getSearchPage');
Route::get('/product/search','ProductController@formsearch');
Route::post('/product/search', 'ProductController@formSearch');
Route::get('/product_details/{id}','SellerproductController@product_details');
Route::get('/productsearch','SellerproductController@products');
Route::post('/productsearch','SellerproductController@search');
Route::get('/product','SellerproductController@product');
Route::get('/products','SellerproductController@sellerproduct');
Route::get('/charities_list','CharityController@charities_list');
Route::post('/product/{id}','CharityController@product');
Route::get('/fetch_subject/{id}','InboxController@subject');

Route::post('/seller_offer/{id}','SellerproductController@offers');
Route::get('/product_category','SellerproductController@product_category');

//charity list
Route::get('/charity_request_details/{id}','AdsController@charity_request_details');
Route::post('/search','CharityController@search');

Route::get('/search','CharityController@search');
Route::get('/charities','CharityController@charity_list');
Route::get('/charity_name','CharityController@fetch_charity');
Route::get('/charity_type','CharityController@charity_type');




//message part
Route::get('/create_message','MessageController@index');
Route::post('/create_message','InboxController@store');
Route::get('/get_user','UserController@index');
Route::get('/get_inbox','InboxController@fetch');
Route::get('/getmessage','InboxController@index');
Route::get('/user_detail/{id}','InboxController@detail');
Route::post('/message/{id}','InboxController@message');
Route::get('/user_id','InboxController@user_id');
Route::get('/senderinfo/{id}','InboxController@senderinfo');
Route::get('/unread','InboxController@unread');
Route::post('/inboxstatus/{id}','InboxController@update_inbox_status');

Route::get('/unread_message_seller','InboxController@unread_message_seller');
Route::get('/unread_message_charity','InboxController@unread_message_charity');



Route::get('/product_name','CharityController@product_name');
Route::get('/unread_msg','InboxController@unread_msg');
//Notification

Route::post('/update_donation/{id}', 'CharityController@update_donation');
Route::post('/reject_donation/{id}', 'CharityController@reject_donation');


Route::get('/count','InboxController@count');
Route::post('/read/{id}','InboxController@read');
Route::post('request_charity/{id}','SellerController@request_store');
Route::get('request_charity','SellerController@requests');
Route::get('/charity_name/{id}','SellerController@charity_name');
Route::post('/reject_request/{id}', 'SellerController@reject_request');
Route::post('/update_request/{id}', 'SellerController@update_request');
Route::post('/searchform', 'CharityController@search');
Route::get('/searchform', 'CharityController@search');
Route::get('/charity_list_user','CharityController@charity_list_user');
Route::post('/post_contact','AuthController@postContact');
Route::get('/show_charities_request','AdsController@requests');
Route::get('/message_notification','InboxController@message_notification');
Route::get('/user_notification','InboxController@user_notification');
Route::get('/requests/{id}','AdsController@request_charities');