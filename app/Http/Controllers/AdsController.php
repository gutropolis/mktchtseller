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
		$show_ads = $query->latest()->get();
		//$show_ads=my_ads::all();
        return response()->json($show_ads);
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
			//return($request);
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
		$request=my_ads::where('charity_organisation',$charity_details->id)->first();
		return response()->json(array('data1'=>$request,'data2'=>$charity_details));	
    }
	
	public function store(Request $request)
    {
	   
       if($request->get('image'))
				{
					$image = $request->get('image');
					$name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
					\Image::make($request->get('image'))->save(public_path('images/charityads/').$name);
				}
		
      
			$create_ads = new \App\my_ads;
			$create_ads->title=$request->input('data.title');
			$create_ads->description=$request->input('data.description');			
			$create_ads->charity_organisation=$request->input('data.ads_type');
			$create_ads->image=$name;
			$user = JWTAuth::parseToken()->authenticate();
			$create_ads->user_id = $user->id;	
			 $create_ads->status="0";
			$create_ads->save();
			$create_adsId = $create_ads->id;
	$create_ads = my_ads::where('id',$create_adsId)->first();
	
	
	$user = JWTAuth::parseToken()->authenticate();
		$admin_email=Settings::pluck('admin_email');
		$admin=$admin_email[0];
		
		 $data = array('create_ads'=>$create_ads,'user'=>$user);
		Mail::send('emails.request', $data , function($message) use($admin)
		{
			$message->to($admin)->subject('Charity Request!');
		});
	 
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
		
		$charity=Charity::where('id',$edit_ads->ads_type)->pluck('title');
		return response()->json(array('data1'=>$edit_ads,'data2'=>$charity[0]));	
   
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
		$ads_update->image=$request->get('image');
		//$ads_update->location=$request->get('location');
		$ads_update->ads_type=$request->get('ads_type');
		
		$ads_update->save();
     return response()->json(['message' => 'Data update Successfully']);

    
	}
 
}
