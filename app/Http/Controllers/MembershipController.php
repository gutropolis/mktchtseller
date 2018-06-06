<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\charityRequest;
use App\my_ads;
use App\Subscription;
use App\Sellerproduct;
use App\Events\MessageDonation;
use App\User;
use App\Membership;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use App\Events\DonationStatusChanged;
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


class MembershipController extends Controller
{
     public function index()
    {
		$user = JWTAuth::parseToken()->authenticate();
			$pack=Membership::all();
			//$remaining_credit=Subscription::where('user_id',$user->id)->pluck('remaining_credit');
			return $pack;
    }
    
   
    public function remaning_credit()
    {
      $user= JWTAuth::parseToken()->authenticate();
	  $subscription=Subscription::where('user_id',$user->id)->first();
	  return $subscription;
	  
	  
	  
    }  
	public function select_plan($id)
	{
			$packs=Membership::where('id',$id)->first();
			return($packs);
			
		
		
	}
	
     public function select_pack($id){
		 $user = JWTAuth::parseToken()->authenticate();
		 $pack=Membership::find($id);
		 $store= new \App\Subscription;
		 $store->user_id=$user->id;
		 $store->membership_id=$pack->id;
		 $store->credit=$pack->credit_score;
		 $store->trial_units='10';
		 $store->remaining_credit=$pack->credit_score;
		 $store->status="1";
		 $store->save();
		
        
    }

     public function edit($id)
    {
        
    }
      public function destroy($id)
    {
       
    
    }
    

    /**
     * User update form processing page.
     *
     * @param  seller $user
     * @param SellerRequest $request
     * @return Redirect
     */
    public function update(Request $request,$id)
    {
        
      

    
    }
 
}
