<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\JoshController;
//use App\Http\Requests\membershipRequest;
use App\Membership;
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
//use config;


class MembershipController extends JoshController
{

    

    public function index()
    {

      $membership=Membership::all();
        return view('admin.membership.index',compact('membership'));
    }
	 public function data()
    {
        $membership = membership::get(['id', 'package_name', 'amount','currency', 'credit_score','created_at']);

        return DataTables::of($membership)
            ->editColumn('created_at',function(membership $membership) {
                return $membership->created_at->diffForHumans();
            })

               
            ->addColumn('actions',function($membership) {
                $actions = '<a href='. route('admin.membership.edit', $membership->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update membership"></i></a>';
            
                    $actions .= '<a href='. route('admin.membership.confirm-delete', $membership->id) .' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete membership"></i></a>';
                
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

   
   
    public function store(Request $request)
    {
		membership::create($request->all());
        return redirect()->route('admin.membership.index')
                        ->with('success','New Record created successfully');
	 
	
       
		
      
	}
	public function update(Request $request,$id)
    {
		
        
		 Membership::find($id)->update($request->all());
        return redirect()->route('admin.membership.index')
                        ->with('success','Data update created successfully');
	 
	
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
		 return view('admin.membership.create');
    }
	 public function edit($id)
    {
		$membership=membership::find($id);
		//echo $membership->title;
		//exit;
	 return view('admin.membership.edit',compact('membership'));
    }
    
    public function destroy($id)
	{
     try {
            // Get user information
            $membership = Sentinel::findById($id);
           
            membership::destroy($id);
            
            $success = trans('membership/message.success.delete');
           
           
            // Redirect to the user management page
            return Redirect::route('admin.membership.index')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('admin/membership/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.membership.index')->with('error', $error);
        }
    }
	
	public function getModalDelete($id)
    {
		$model = 'membership';
        $confirm_route = $error = null;
        try {
            // Get user information
            $membership = Sentinel::findById($id);
			
            // Check if we are not trying to delete ourselves
           
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('membership/message.user_not_found', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        $confirm_route = route('admin.membership.delete', [$id]);
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
        
    }

    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
       $membership = membership::find($id);
return view('admin.membership.show',compact('membership'));
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
