<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\charityRequest;
use App\my_ads;
use App\Charity;
use App\Sellerproduct;
use App\Events\MessageDonation;
use App\User;
use App\Packages;
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
			$pack=Packages::all();
        
        
        return ($pack);
    }
    
   
        
  
    
    
    
    
    public function store(Request $request)
    {
      $user = JWTAuth::parseToken()->authenticate();
            $create_ads = new \App\my_ads;
            $create_ads->title=$request['title'];
            $create_ads->description=$request['description'];            
            $create_ads->charity_organisation=$request['ads_type'];
           
            $user = JWTAuth::parseToken()->authenticate();
            $create_ads->user_id = $user->id;    
             $create_ads->status="0";
            $create_ads->save();
            $create_adsId = $create_ads->id;
			$create_ads = my_ads::where('id',$create_adsId)->first();
			$admin_email=Settings::pluck('admin_email');
			$admin=$admin_email[0];
        
         $data = array('create_ads'=>$create_ads,'user'=>$user);
        Mail::send('emails.request', $data , function($message) use($admin)
        {
            $message->to($admin)->subject('Charity Request!');
        });
		$actvity=new Controller;
		$actvity->AddActivityFeed($user->id,$user->id,'charity','Post Our Need For Charity Organization',$create_ads->charity_organisation,'/my_Ads');
         return response()->json(['message' => 'Your Ads sucessfully Added']);
    }
     public function activate($activation_token){
        $request = \App\my_ads::whereActivationToken($activation_token)->first();
		$request->status = '1';
        $request->save();
        return response()->json(['message' => 'Charity request has been activated!']);
    }

     public function edit($id)
    {
        $edit_ads = my_ads::find($id);
         
        $charity=Charity::all();
            
        return response()->json(array('data1'=>$edit_ads,'data2'=>$charity));    
   
    }
      public function destroy($id)
    {
         $ads = my_ads::find($id);
      $ads->delete();

     return response()->json(['message' => 'Data Deleted Successfully']);
    
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
        
       $ads_update=my_ads::find($id);
        $ads_update->title=$request->get('title');
        $ads_update->description=$request->get('description');
        $ads_update->charity_organisation=$request->get('charity_organisation');
        
        $ads_update->save();
     return response()->json(['message' => 'Data update Successfully']);

    
    }
 
}
