<?php
include_once 'web_builder.php';
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

Route::pattern('slug', '[a-z0-9- _]+');

Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function () {

    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return view('admin/404');
    });
    Route::get('500', function () {
        return view('admin/500');
    });
    # Lock screen
    Route::get('{id}/lockscreen', 'UsersController@lockscreen')->name('lockscreen');
    Route::post('{id}/lockscreen', 'UsersController@postLockscreen')->name('lockscreen');
	
    # All basic routes defined here
    Route::get('login', 'AuthController@getSignin')->name('login');
    Route::get('signin', 'AuthController@getSignin')->name('signin');
    Route::post('signin', 'AuthController@postSignin')->name('postSignin');
    Route::post('signup', 'AuthController@postSignup')->name('admin.signup');
    Route::post('forgot-password', 'AuthController@postForgotPassword')->name('forgot-password');
    Route::get('login2', function () {
        return view('admin/login2');
    });


    # Register2
    Route::get('register2', function () {
        return view('admin/register2');
    });
    Route::post('register2', 'AuthController@postRegister2')->name('register2');

    # Forgot Password Confirmation
    Route::get('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm')->name('forgot-password-confirm');
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm');

    # Logout
    Route::get('logout', 'AuthController@getLogout')->name('logout');

    # Account Activation
    Route::get('activate/{userId}/{activationCode}', 'AuthController@getActivate')->name('activate');
});


Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    # GUI Crud Generator
    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('generator_builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');
    // Model checking
    Route::post('modelCheck', 'ModelcheckController@modelCheck');

    # Dashboard / Index
    Route::get('/', 'JoshController@showHome')->name('dashboard');
    # crop demo
    Route::post('crop_demo', 'JoshController@crop_demo')->name('crop_demo');
    //Log viewer routes
    Route::get('log_viewers', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index')->name('log-viewers');
    Route::get('log_viewers/logs', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs')->name('log_viewers.logs');
    Route::delete('log_viewers/logs/delete', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete')->name('log_viewers.logs.delete');
    Route::get('log_viewers/logs/{date}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show')->name('log_viewers.logs.show');
    Route::get('log_viewers/logs/{date}/download', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download')->name('log_viewers.logs.download');
    Route::get('log_viewers/logs/{date}/{level}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel')->name('log_viewers.logs.filter');
    Route::get('log_viewers/logs/{date}/{level}/search', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@search')->name('log_viewers.logs.search');
    Route::get('log_viewers/logcheck', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@logCheck')->name('log-viewers.logcheck');
    //end Log viewer
    # Activity log
    Route::get('activity_log/data', 'JoshController@activityLogData')->name('activity_log.data');
  
//    Route::get('/', 'JoshController@index')->name('index');
});

Route::group(['prefix' => 'admin','namespace'=>'Admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {

    # User Management
    Route::group([ 'prefix' => 'users'], function () {
        Route::get('data', 'UsersController@data')->name('users.data');
        Route::get('{user}/delete', 'UsersController@destroy')->name('users.delete');
        Route::get('{user}/confirm-delete', 'UsersController@getModalDelete')->name('users.confirm-delete');
        Route::get('{user}/restore', 'UsersController@getRestore')->name('restore.user');
//        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
        Route::post('passwordreset', 'UsersController@passwordreset')->name('passwordreset');

    });
	
	
	//payment Settings
	 Route::group([ 'prefix' => 'payments'], function () {
        Route::get('data', 'PaymentsController@data')->name('payments.data');
	 });
       
	 Route::resource('payments', 'PaymentsController');
	
	
      Route::get('donation_list/data', 'DonationController@donation_listData')->name('donation_list.data');
       Route::get('{donation}/delete', 'DonationController@destroy')->name('donation.delete');
        Route::get('{donation}/confirm-delete', 'DonationController@getModalDelete')->name('donation.confirm-delete');
		 Route::resource('donation', 'DonationController');
	
	//charity management
    Route::group([ 'prefix' => 'charity'], function () {
        Route::get('data', 'CharityController@data')->name('charity.data');
        Route::get('{charity}/delete', 'CharityController@destroy')->name('charity.delete');
        Route::get('{charity}/confirm-delete', 'CharityController@getModalDelete')->name('charity.confirm-delete');
       
    });
	  Route::resource('charity', 'CharityController');

   

Route::group(['prefix' => 'charityrequests'], function () {
        Route::get('{charityrequests}/delete', 'CharityRequestController@destroy')->name('charityrequests.delete');
   Route::get('{charityrequests}/accept', 'CharityRequestController@accept')->name('charityrequests.accept');
    Route::get('{charityrequests}/deactivate', 'CharityRequestController@deactivate')->name('charityrequests.deactivate');
   
        Route::get('{charityrequests}/confirm-delete', 'CharityRequestController@getModalDelete')->name('prodcutcategory.confirm-delete');
        Route::get('{charityrequests}/restore', 'CharityRequestController@getRestore')->name('productcategory.restore');
    });
    Route::resource('charityrequests','CharityRequestController');


  
    
        Route::get('deleted_users',['before' => 'Sentinel', 'uses' => 'charityController@getDeletedUsers'])->name('deleted_users');
		
		
		//Membership
		
		  Route::group([ 'prefix' => 'membership'], function () {
        Route::get('data', 'MembershipController@data')->name('membership.data');
        Route::get('{membership}/delete', 'MembershipController@destroy')->name('membership.delete');
        Route::get('{membership}/confirm-delete', 'MembershipController@getModalDelete')->name('membership.confirm-delete');
        //Route::get('{user}/restore', 'charityController@getRestore')->name('restore.user');
//        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
       // Route::post('passwordreset', 'charityController@passwordreset')->name('passwordreset');
    });

    Route::resource('membership', 'MembershipController');
		
		
		 //Routes for settings
  Route::group([ 'prefix' => 'settings'], function () {
        //Route::get('data', 'charityController@data')->name('charity.data');
       // Route::get('{charity}/delete', 'charityController@destroy')->name('charity.delete');
       // Route::get('{charity}/confirm-delete', 'charityController@getModalDelete')->name('charity.confirm-delete');
        //Route::get('{user}/restore', 'charityController@getRestore')->name('restore.user');
//        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
       // Route::post('passwordreset', 'charityController@passwordreset')->name('passwordreset');
    });

    Route::resource('settings', 'SettingsController');
		
    /*routes for Charity category*/
    Route::group(['prefix' => 'charitycategory'], function () {
       Route::get('{charitycategory}/delete', 'CharityCategoryController@destroy')->name('charitycategory.delete');
       // Route::get('{charitycategory}/confirm-delete', 'CharityCategoryController@getModalDelete')->name('charitycategory.confirm-delete');
      //  Route::get('{charityCategory}/restore', 'CharityCategoryController@getRestore')->name('charitycategory.restore');
    });
    Route::resource('charitycategory', 'CharityCategoryController');
        
    Route::resource('users', 'UsersController');

    Route::get('deleted_users',['before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'])->name('deleted_users');
	 # Seller Management
	 
    Route::group([ 'prefix' => 'seller'], function () {
        Route::get('data', 'SellerController@data')->name('seller.data');
        Route::get('{seller}/delete', 'SellerController@destroy')->name('seller.delete');
        Route::get('{seller}/confirm-delete', 'SellerController@getModalDelete')->name('seller.confirm-delete');
        Route::get('{seller}/restore', 'SellerController@getRestore')->name('restore.seller');
//        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
        Route::post('passwordreset', 'SellerController@passwordreset')->name('passwordreset');

    });
	 Route::resource('seller', 'SellerController');
	 Route::group([ 'prefix' => 'sellerproduct'], function () {
        
        Route::get('{sellerproduct}/delete', 'SellerproductController@destroy')->name('sellerproduct.delete');
        Route::get('{sellerproduct}/confirm-delete', 'SellerproductController@getModalDelete')->name('sellerproduct.confirm-delete');
		Route::post('/formsearch','SellerproductController@formsearch')->name('sellerproduct.formSearch');
	 });
	Route::resource('sellerproduct','SellerproductController');
 

    Route::get('deleted_seller',['before' => 'Sentinel', 'uses' => 'SellerController@getDeletedSeller'])->name('deleted_seller');

    # Group Management
    Route::group(['prefix' => 'groups'], function () {
        Route::get('{group}/delete', 'GroupsController@destroy')->name('groups.delete');
        Route::get('{group}/confirm-delete', 'GroupsController@getModalDelete')->name('groups.confirm-delete');
        Route::get('{group}/restore', 'GroupsController@getRestore')->name('groups.restore');
    });
    Route::resource('groups', 'GroupsController');

    /*routes for blog*/
    Route::group(['prefix' => 'blog'], function () {
        Route::get('{blog}/delete', 'BlogController@destroy')->name('blog.delete');
        Route::get('{blog}/confirm-delete', 'BlogController@getModalDelete')->name('blog.confirm-delete');
        Route::get('{blog}/restore', 'BlogController@restore')->name('blog.restore');
        Route::post('{blog}/storecomment', 'BlogController@storeComment')->name('storeComment');
    });
	
	 Route::group([ 'prefix' => 'cms'], function () {
        Route::get('data', 'CmsController@data')->name('cms.data');
        Route::get('{cms}/delete', 'CmsController@destroy')->name('cms.delete');
        Route::get('{cms}/confirm-delete', 'CmsController@getModalDelete')->name('cms.confirm-delete');
        Route::get('{cms}/restore', 'CmsController@getRestore')->name('restore.cms');
//        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
        Route::post('passwordreset', 'CmsController@passwordreset')->name('passwordreset');

    });
    Route::resource('cms', 'CmsController');

    Route::get('deleted_cms',['before' => 'Sentinel', 'uses' => 'CmsController@getDeletedcms'])->name('deleted_cms');
	
	
	
	

    Route::resource('blog', 'BlogController');

    /*routes for blog category*/
    Route::group(['prefix' => 'blogcategory'], function () {
        Route::get('{blogCategory}/delete', 'BlogCategoryController@destroy')->name('blogcategory.delete');
        Route::get('{blogCategory}/confirm-delete', 'BlogCategoryController@getModalDelete')->name('blogcategory.confirm-delete');
        Route::get('{blogCategory}/restore', 'BlogCategoryController@getRestore')->name('blogcategory.restore');
    });
    Route::resource('blogcategory', 'BlogCategoryController');
	
	
	 /*routes for seller category*/
    Route::group(['prefix' => 'sellercategory'], function () {
        Route::get('{sellerCategory}/delete', 'SellerCategoryController@destroy')->name('sellercategory.delete');
        Route::get('{sellerCategory}/confirm-delete', 'SellerCategoryController@getModalDelete')->name('Sellercategory.confirm-delete');
        Route::get('{sellerCategory}/restore', 'SellerCategoryController@getRestore')->name('sellercategory.restore');
    });
    Route::resource('sellercategory', 'SellerCategoryController');
	 /*routes for seller category*/
    Route::group(['prefix' => 'productcategory'], function () {
        Route::get('{productcategory}/delete', 'ProductCategoryController@destroy')->name('productcategory.delete');
        Route::get('{productcategory}/confirm-delete', 'ProductCategoryController@getModalDelete')->name('prodcutcategory.confirm-delete');
        Route::get('{productcategory}/restore', 'ProductCategoryController@getRestore')->name('productcategory.restore');
    });
    Route::resource('productcategory', 'ProductCategoryController');
	
    /*routes for file*/
    Route::group(['prefix' => 'file'], function () {
        Route::post('create', 'FileController@store')->name('store');
        Route::post('createmulti', 'FileController@postFilesCreate')->name('postFilesCreate');
        Route::delete('delete', 'FileController@delete')->name('delete');
    });

    Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });


    /* laravel example routes */
    #Charts
    Route::get('laravel_chart', 'ChartsController@index')->name('laravel_chart');
    Route::get('database_chart', 'ChartsController@databaseCharts')->name('database_chart');

    # datatables
    Route::get('datatables', 'DataTablesController@index')->name('index');
    Route::get('datatables/data', 'DataTablesController@data')->name('datatables.data');

    # SelectFilter
    Route::get('selectfilter', 'SelectFilterController@index')->name('selectfilter');
    Route::get('selectfilter/find', 'SelectFilterController@filter')->name('selectfilter.find');
    Route::post('selectfilter/store', 'SelectFilterController@store')->name('selectfilter.store');

    # editable datatables
    Route::get('editable_datatables', 'EditableDataTablesController@index')->name('index');
    Route::get('editable_datatables/data', 'EditableDataTablesController@data')->name('editable_datatables.data');
    Route::post('editable_datatables/create', 'EditableDataTablesController@store')->name('store');
    Route::post('editable_datatables/{id}/update', 'EditableDataTablesController@update')->name('update');
    Route::get('editable_datatables/{id}/delete', 'EditableDataTablesController@destroy')->name('editable_datatables.delete');

//    # custom datatables
    Route::get('custom_datatables', 'CustomDataTablesController@index')->name('index');
    Route::get('custom_datatables/sliderData', 'CustomDataTablesController@sliderData')->name('custom_datatables.sliderData');
    Route::get('custom_datatables/radioData', 'CustomDataTablesController@radioData')->name('custom_datatables.radioData');
    Route::get('custom_datatables/selectData', 'CustomDataTablesController@selectData')->name('custom_datatables.selectData');
    Route::get('custom_datatables/buttonData', 'CustomDataTablesController@buttonData')->name('custom_datatables.buttonData');
    Route::get('custom_datatables/totalData', 'CustomDataTablesController@totalData')->name('custom_datatables.totalData');

    //tasks section
    Route::post('task/create', 'TaskController@store')->name('store');
    Route::get('task/data', 'TaskController@data')->name('data');
    Route::post('task/{task}/edit', 'TaskController@update')->name('update');
    Route::post('task/{task}/delete', 'TaskController@delete')->name('delete');

});
 



# Remaining pages will be called from below controller method
# in real world scenario, you may be required to define all routes manually

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('{name?}', 'JoshController@showView');
});

Route::get('/auth/social/{provider}', 'SocialAuthController@providerRedirect');
Route::get('/auth/{provider}/callback', 'SocialAuthController@providerRedirectCallback');


#frontend views
Route::get('/{vue?}', function () {
    return view('index');
})->where('vue', '[\/\w\.-]*')->name('index');




Route::get('/', ['as' => 'home', function () {
    return view('index');
}]);


Route::get('blog','BlogController@index')->name('blog');
Route::get('blog/{slug}/tag', 'BlogController@getBlogTag');
Route::get('blogitem/{slug?}', 'BlogController@getBlog');
Route::post('blogitem/{blog}/comment', 'BlogController@storeComment');


Route::get('{name?}', 'FrontEndController@showFrontEndView');
# End of frontend views
