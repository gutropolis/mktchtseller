<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\JoshController;
use App\Http\Requests\charityRequest;
use App\Charity;
use App\CharityCategory;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Sentinel;
use URL;
use View;
use Yajra\DataTables\DataTables;
use Validator;
Use App\Mail\Restore;
use stdClass;


class CharityController extends JoshController
{

    public function index()
    {

        // Show the page
		//$charity=Charity::all();
        
        return view('admin.charity.index', compact('charity'));
    }
 public function data()
    {
        $charity = Charity::get(['id', 'title', 'description', 'state','city','created_at']);
		return($charity);

        return DataTables::of($charity)
            ->editColumn('created_at',function(charity $charity) {
                return $charity->created_at->diffForHumans();
            })
            
            ->addColumn('actions',function($charity) {
                $actions = '<a href='. route('admin.charity.show', $charity->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                            <a href='. route('admin.charity.edit', $charity->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>';
                if ((Sentinel::getUser()->id != $charity->id) && ($charity->id != 1)) {
                    $actions .= '<a href='. route('admin.charity.confirm-delete', $charity->id) .' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>';
                }
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
   
    public function store(Request $request)
    {
        if ($file = $request->file('pic_file')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/images/charity/';
            $safeName = str_random(10) . '.' . $extension;
			
            $file->move($destinationPath, $safeName);
            $request['images'] = $safeName;
			
		 }
		
      $charity=\App\Charity::create([
			'title'=> request('title'),
			'description'=> request('description'),
			'location'=> request('location'),
			'year_in_business'=> request('year_in_business'),
			'years_inception'=> request('years_inception'),
			'business_purpose'=> request('business_purpose'),
			'postal_code'=> request('postal_code'),
			'area_code' =>request('area_code'),
			'phone_number'=> request('phone_number'),
			'website'=> request('website'),
			
			'vision_statement'=> request('vision_statement'),
			'mission_statement'=> request('mission_statement'),
			'tags'=> request('tags'),
			'charity_type'=> request('charity_type'),
			'post_type'=>'charity',
			'images'=> request('images'),
			'updated_by' => Sentinel ::getUser()->first_name,
			'user_id'	=>	Sentinel:: getUser()->id,
			]);
			
        return redirect()->route('admin.charity.index')
                        ->with('success','New Record created successfully');
	}
	public function update(Request $request,$id)
    {
		 if ($file = $request->file('pic_file')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/images/charity/';
            $safeName = str_random(10) . '.' . $extension;
			
            $file->move($destinationPath, $safeName);
            $request['images'] = $safeName;
			
		 }
        
		
		
        Charity::find($id)->update($request->all());
        return redirect()->route('admin.charity.index')
                        ->with('success','Update Charity successfully');
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
		$charityparcategory=CharityCategory::all()->where('parent_id','=','0');
        $charitycategory=CharityCategory::all()->where('parent_id','>','0');
       // echo $charitycategory;
        //exit;
        
         return view('admin.charity.create', compact('charitycategory','charityparcategory'));

    }
	 public function edit(Charity $charity)
    {

             $charityparcategory=CharityCategory::all()->where('parent_id','=','0');
			 $msgInbox=array();
             $charitycategory=CharityCategory::all()->where('parent_id','>','0');
			
        return view('admin.charity.edit', compact('charity','charitycategory','charityparcategory'));
    }
    
    public function destroy($id)
	{
     try {
            // Get user information
            $charity = Sentinel::findById($id);
           
            Charity::destroy($id);
            
            $success = trans('charity/message.success.delete');
           
           
            // Redirect to the user management page
            return Redirect::route('admin.charity.index')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('admin/charity/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.charity.index')->with('error', $error);
        }
    }
	
	public function getModalDelete($id)
    {
        $model = 'Charity';
        $confirm_route = $error = null;
        try {
            // Get user information
            $charity = Sentinel::findById($id);
			
            // Check if we are not trying to delete ourselves
           
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('charity/message.user_not_found', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        $confirm_route = route('admin.charity.delete', [$id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Restore a deleted user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getRestore($id)
    {
        $data = new stdClass();
        try {
            // Get user information
            $charity = charity::withTrashed()->find($id);
            info($user);
            // Restore the user
            $user->restore();
            // create activation record for user and send mail with activation link
            $data->user_name = $user->first_name .' '. $user->last_name;
            $data->activationUrl = URL::route('activate', [$user->id, Activation::create($user)->code]);
            // Send the activation code through email
            Mail::to($user->email)
                ->send(new Restore($data));
            // Prepare the success message
            $success = trans('users/message.success.restored');
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('User restored by '.Sentinel::getUser()->full_name);
            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('error', $error);
        } 
    }

    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
       
$charity = Charity::find($id);
        return view('admin.charity.show',compact('charity'));
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
