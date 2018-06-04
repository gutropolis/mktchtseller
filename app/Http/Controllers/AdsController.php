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
use App\Settings;
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


class AdsController extends Controller
{
     public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
         $query = \App\my_ads::whereUserId($user->id);
        $requests = $query->latest()->get();
        $requestsArr=array();
        
        foreach($requests as $request){
        
            $charities = Charity::where('id',$request->charity_organisation)->get();
            $charitiesArr = array();
            $charitiesArr['charity_detail']=$charities;
            $request['charity_detail']=$charities;
            array_push($requestsArr,$request);
            
        }
        
        return response()->json($requestsArr);
    }
    
    public function charity()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $query=\App\Charity::whereUserId($user->id);
        $qu=$query->get();
        return($qu);
        
    }
        public function requests()
		{
            $request=my_ads::where('status',1)->get();
            $requestarr=array();
            
            foreach($request as $req)
            {
            $charities = Charity::where('id',$req->charity_organisation)->get();
            $charitiesArr = array();
            $charitiesArr['charity_detail']=$charities;
            $req['charity_detail']=$charities;
            array_push($requestarr,$req);
            
            }
            return response()->json($requestarr);
            
        }
    
    public function charity_request_details(Request $request,$id)
    {
        
        $charity_details = Charity::where('id',$id)->first();
        //return($charity_details);
        $request=my_ads::where('charity_organisation',$charity_details->id)->where('id','!=',$id)->first();
        if($request=='')
        {
        $request_list=my_ads::where('charity_organisation',$charity_details->id)->get();
        }else{
            $request_list=my_ads::where('charity_organisation',$charity_details->id)->where('id','!=',$request->id)->get();
        }
        return response()->json(array('data1'=>$request,'data2'=>$charity_details,'data3'=>$request_list));    
    }
    
    public function request_charities(Request $request,$id)
    {
        $request=my_ads::where('id',$id)->latest()->first();
        $charity_details = Charity::where('id',$request->charity_organisation)->first();
        $request_list=my_ads::where('charity_organisation',$charity_details->id)->where('id','!=',$request->id)->get();
        return response()->json(array('data1'=>$request,'data2'=>$charity_details,'data3'=>$request_list));    
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
