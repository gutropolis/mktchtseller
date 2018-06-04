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
			$pack=Membership::all();
        
        
        return ($pack);
    }
    
   
        
  
    
    
    
    
    public function store(Request $request)
    {
      
    }
     public function activate($activation_token){
        
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
