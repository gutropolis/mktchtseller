<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\JoshController;
use App\Http\Requests\charityRequest;
use App\Settings;
//use App\CharityCategory;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Sentinel;
use URL;
use View;
//use Yajra\DataTables\DataTables;
use Validator;
Use App\Mail\Restore;
use stdClass;
use config;


class SettingsController extends JoshController
{

    

    public function index(Request $request)
    {

       //$config=config('app.url');
	  // config::get('app.url');
	   //echo config;
	  
	  // exit;
	 $settings = Settings::find(1);
        //echo $settings->site_title;
		//exit;
        return view('admin.setting.index',compact('settings'));
    }

   
   
    public function store(Request $request)
    {
        
		if ($file = $request->file('image')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/charity/';
            $safeName = str_random(10) . '.' . $extension;
			
            $file->move($destinationPath, $safeName);
            $request['site_logo'] = $safeName;
			
		 }
        request()->validate([
			'site_url'=>'required',
            
           
        ]);
		
		
	
	
		
		
        Settings::find(1)->update($request->all());
        return redirect()->route('admin.settings.index')
                        ->with('success','Update Settings successfully');
		
	 
	
       
		
      
	}
	public function update(Request $request,$id)
    {
	if ($file = $request->file('site_logo')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/charity/';
            $safeName = str_random(10) . '.' . $extension;
			
            $file->move($destinationPath, $safeName);
            $request['site_logo'] = $safeName;
			
		 }
        request()->validate([
			'site_title'=>'required',
            
           
        ]);
		
		
	
	
		
		
        Settings::find(1)->update($request->all());
        return redirect()->route('admin.settings.index')
                        ->with('success','Update Settings successfully');
	}
    

    /**
     * User update form processing page.
     *
     * @param  charity $user
     * @param charityRequest $request
     * @return Redirect
     */
	  public function create()
    {
		
    }
	 public function edit(charity $charity)
    {
 
    }
    
    public function destroy($id)
	{
     
    }
	
	public function getModalDelete($id)
    {
        
    }

    /**
     * Restore a deleted user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getRestore($id)
    {
        
    }

    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
       

    }

    public function passwordreset( Request $request)
    {
       
    }

    public function lockscreen($id)
	{

        
    }

    public function postLockscreen(Request $request){
       
    }
}
