<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\JoshController;
use App\Http\Requests\UserRequest;
use App\Users;
use App\Packages;
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


class PlansController extends JoshController
{

    /**
     * Show a list of all the users.
     *
     * @return View
     */

    public function index()
    {

        // Show the page
        return view('admin.plans.index', compact('users'));
    }

    /*
     * Pass data through ajax call
     */
    /**
     * @return mixed
     */
    public function data()
    {
		//$plans=Packages::all();
		
        $plans = Packages::get(['id', 'package_name', 'amount', 'trial_period','currency','interval','interval_count','created_at']);
		//return($plans);

        return DataTables::of($plans)
            ->editColumn('created_at',function(Packages $plans) {
                return $plans->created_at->diffForHumans();
            })
            
            ->addColumn('actions',function($plans) {
                $actions = '<a href='. route('admin.plans.edit', $plans->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update package"></i></a>';
                
                    $actions .= '<a href='. route('admin.plans.confirm-delete', $plans->id) .' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="plans-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>';
                
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Create new user
     *
     * @return View
     */
    public function create()
    {
        
        return view('admin.plans.create');
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
       
       
          
		 $charity= new \App\Packages;
			$charity->package_name = request('package_name');
			$charity->amount = request('amount');
			$charity->currency = request('currency');
			$charity->interval = request('interval');
			$charity->interval_count = request('interval_count');
			$charity->trial_period = request('trail');
			$charity->save();
			/*'description'=> request('description'),
			'location'=> request('location'),
			'year_in_business'=> request('year_in_business'),
			'years_inception'=> request('years_inception'),
			'business_purpose'=> request('business_purpose'),
			'postal_code'=> request('postal_code'),
			'area_code' =>request('area_code'),
			'phone_number'=> request('phone_number'),
			'website'=> request('website'),
		
			$user->save();*/
           
			/*if ($charity->save()) {
                // Prepare the success message
                $success =trans('users/message.success.create');
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('New User Created by '.Sentinel::getUser()->full_name);*/
            // Redirect to the home page with success menu
            return Redirect::route('admin.plans.index')->with('success', trans('users/message.success.create'));
			}
        

       
    

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit()
    {
		
       $plans=Packages::all();

        // Show the page
        return view('admin.plans.edit', compact('plans'));
    }

    /**
     * User update form processing page.
     *
     * @param  User $user
     * @param UserRequest $request
     * @return Redirect
     */
    public function update(Request $request,$id)
    {
         Packages::find($id)->update($request->all());
        return redirect()->route('admin.plans.index')
                        ->with('success','Update plan successfully');
	}
    /**
     * Show a list of all the deleted users.
     *
     * @return View
     */
    public function getDeletedPlan()
    {
        // Grab deleted users
        $plans = Packages::onlyTrashed()->get();

        // Show the page
        return view('admin.deleted_plans', compact('plans'));
    }


    /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id)
    {
        $model = 'Packages';
        $confirm_route = $error = null;
        try {
            // Get user information
            $plans = Sentinel::findById($id);
			
            // Check if we are not trying to delete ourselves
           
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('charity/message.user_not_found', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        $confirm_route = route('admin.plans.delete', [$id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given user.
     *
     * @param  int $id
     * @return Redirect
     */
      public function destroy($id)
	{
     try {
            // Get user information
            $plan = Sentinel::findById($id);
           
            Packages::destroy($id);
            
            $success = trans('plan/message.success.delete');
           
           
            // Redirect to the user management page
            return Redirect::route('admin.plans.index')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('admin/charity/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.charity.index')->with('error', $error);
        }
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
            $user = User::withTrashed()->find($id);
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
        try {
            // Get the user information
            $user = Sentinel::findUserById($id);
            //get country name
            if ($user->country) {
                $user->country = $this->countries[$user->country];
            }
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));
            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }
        // Show the page
        return view('admin.users.show', compact('user'));

    }

    public function passwordreset( Request $request)
    {
        $id = $request->id;
        $user = Sentinel::findUserById($id);
        $password = $request->get('password');
        $user->password = Hash::make($password);
        $user->save();
    }

    public function lockscreen($id){

        if (Sentinel::check()) {
            $user = Sentinel::findUserById($id);
            return view('admin.lockscreen',compact('user'));
        }
        return view('admin.login');
    }

    public function postLockscreen(Request $request){
        $password = Sentinel::getUser()->password;
        if(Hash::check($request->password,$password)){
            return 'success';
        } else{
            return 'error';
        }
    }
}
