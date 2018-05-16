<?php namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use App\Http\Requests\SellerRequest;
use App\Seller;
use App\Donation;
use App\Sellerproduct;
use App\User;
use App\Charity;
use App\Http\Requests;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use App\SellerCategory;
use Illuminate\Http\Request;
use App\Settings;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Redirect;
use Sentinel;
use URL;
use View;
use Yajra\DataTables\DataTables;
use Validator;
Use App\Mail\Restore;
use stdClass;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class SellerController extends Controller
{
		protected $avatar_path = 'images/seller/';
    /**
     * Show a list of all the users.
     *
     * @return View
     */

    public function index()
    {

        // Show the page
		$seller=SellerCategory::all();
        return response()->json($seller);
    }
	
	
	public function request_store(Request $request,$id)
    {
		$sellerproduct = Sellerproduct::find($id);
		$charity=Charity::where('id',$request->input('charity_id'))->first();
		//return($charity);
		$donation=new \App\Donation;
		$donation->seller_id = $sellerproduct->user_id;
		
		$donation->product_id=$sellerproduct->id;
		$donation->charity_id=$request->input('charity_id');
		$donation->post_id=$sellerproduct->id;
		$donation->charity_owner_id=$charity->user_id;
		$donation->units=$request->input('units');
		$donation->seller_status="0";
		$donation->is_certify="0";
		$donation->progress="0";
		
		$sender_user=User::where('id',$donation->charity_owner_id)->first();
		
		
		$reciever_user=User::where('id',$donation->seller_id)->first();
		$product=Sellerproduct::where('id',$donation->product_id)->first();
		
	 $data = array('donation'=>$donation, 'sender_user'=>$sender_user,'reciever_user'=>$reciever_user,'product'=>$product);
		 Mail::send('emails.requests_donation', $data , function($message) use ($reciever_user)
		{
			$message->to($reciever_user->email)->subject('Request For Donate!');
		});
		
		
		$donation->save();

		
		

		
		
		return response()->json(['message' => 'Data Record Successfully']);
	
		
    }
	public function update_request($id)
    {
       $donation_request = Donation::where('id',$id)->update(['seller_status' => 1,'charity_status' => 1]);
	   
	     $donation_detail=Donation::where('id',$id)->first();
	   $reciever_user=User::where('id',$donation_detail->charity_owner_id)->first();
	   $sender_user=User::where('id',$donation_detail->seller_id)->first();
	   $product=Sellerproduct::where('id',$donation_detail->product_id)->first();
	   
	   	 $data = array('donation_detail'=>$donation_detail, 'product'=>$product,'reciever_user'=>$reciever_user);
		  
		  $admin_email=Settings::pluck('admin_email');
		$admin=$admin_email[0];
		 
		Mail::send('emails.accept_request_donation', $data , function($message) use($admin)
		{
			$message->to($admin)->subject('Request For Donation Status!');
		});
		Mail::send('emails.accept_request_donation', $data , function($message) use ($reciever_user)
		{
			$message->to($reciever_user->email)->subject('Notify Of Status Of request for Donation!');
		});
		return response()->json(['message' => 'Your Request are Accepted']);
    }
	 public function reject_request($id)
    {
       $donation = Donation::where('id',$id)->update(['seller_status' => 2]);
	    $donation_detail=Donation::where('id',$id)->first();
		//return($donation_detail);
	   $reciever_user=User::where('id',$donation_detail->charity_owner_id)->first();
	 
	   $product=Sellerproduct::where('id',$donation_detail->product_id)->first();
	  // return($product);
	   	 $data = array('donation_detail'=>$donation_detail, 'product'=>$product,'reciever_user'=>$reciever_user);
		 
		 $admin_email=Settings::pluck('admin_email');
		$admin=$admin_email[0];
		 
		Mail::send('emails.reject_request_donation', $data , function($message) use($admin)
		{
			$message->to($admin)->subject('Welcome!');
		});
		 
		 
		
		 
		Mail::send('emails.reject_request_donation', $data , function($message) use ($reciever_user)
		{
			$message->to($reciever_user->email)->subject('Notify!');
			
			
		});
		return response()->json(['message' => 'Your Request are Rejected']);
    }

		public function charity_name($id)
	{
		$charity_name=Charity::where('id',$id)->pluck('title');
		foreach($charity_name as $charity)
		{
			return($charity);
		}
	}
	public function requests(){
		$user = JWTAuth::parseToken()->authenticate();
	
			$date = new \DateTime();
				$date->modify('-3 days');
				$formatted_date = $date->format('Y-m-d H:i:s');
		
			$pending=Donation::select('gs_donation.created_at','gs_donation.units','gs_donation.id','gs_vender_product.images','gs_vender_product.title','gs_charity_organisation.title as charity','gs_donation.charity_id','gs_charity_organisation.updated_by as charity_name')->join('gs_vender_product','gs_vender_product.id','=','gs_donation.product_id')->join('gs_charity_organisation','gs_charity_organisation.id','=','gs_donation.charity_id')->where('gs_donation.created_at', '>',$formatted_date)->where('gs_donation.seller_status','0')->where('gs_donation.seller_id',$user->id)->get();
			
			$accept=Donation::select('gs_donation.created_at','gs_donation.units','gs_donation.id','gs_vender_product.images','gs_vender_product.title','gs_charity_organisation.title as charity','gs_charity_organisation.updated_by as charity_name')->join('gs_vender_product','gs_vender_product.id','=','gs_donation.product_id')->join('gs_charity_organisation','gs_charity_organisation.id','=','gs_donation.charity_id')->where('gs_donation.created_at', '>',$formatted_date)->where('gs_donation.seller_status','1')->where('gs_donation.seller_id',$user->id)->get();
			
		$decline=Donation::select('gs_donation.created_at','gs_donation.units','gs_donation.id','gs_vender_product.images','gs_vender_product.title','gs_charity_organisation.title as charity','gs_charity_organisation.updated_by as charity_name')->join('gs_vender_product','gs_vender_product.id','=','gs_donation.product_id')->join('gs_charity_organisation','gs_charity_organisation.id','=','gs_donation.charity_id')->where('gs_donation.created_at', '>',$formatted_date)->where('gs_donation.seller_status','2')->where('gs_donation.seller_id',$user->id)->get();
		
		return response()->json(array('data1'=>$pending,'data2'=>$accept,'data3'=>$decline));
	}
	
		
	 public function seller_details(Request $request,$id)
    {

        // Show the page
		$seller_details=Seller::find($id);
        return response()->json($seller_details);
    }

    /*
     * Pass data through ajax call
     */
    /**
     * @return mixed
     */
	  public function list_seller()
    {

	
		$user = JWTAuth::parseToken()->authenticate();
		$query = Seller::whereUserId($user->id);
		$seller = $query->latest()->get();
		return response()->json($seller);
    }
	 public function seller_list()
    {

	
		$user = JWTAuth::parseToken()->authenticate();
		$query = Seller::whereUserId($user->id);
		$seller = $query->latest()->paginate(request('pageLength'));
		return response()->json($seller);
    }
   
    /**
     * Create new user
     *
     * @return View
     */
    public function create()
    {
		$sellerpercategory=SellerCategory::all()->where('parent_id','=','0');
    $sellercategory=SellerCategory::all()->where('parent_id','>','0');
        return view('admin.seller.create',compact('sellercategory','sellerpercategory'));
    }
	
	
	public function search(Request $request)
	{		
		$keyword = request('location');    
		$seller=Seller::Where('location', 'like', '%' . $keyword . '%')->get();
	
	  return response()->json($seller);
	}

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
		
		if($request->get('image'))
				{
					$image = $request->get('image');
					$name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
					\Image::make($request->get('image'))->save(public_path('images/seller/').$name);
				}

     
        $seller = new \App\Seller;
		$seller->business_type=$request->input('data1.business_type');
		$seller->title = $request->input('data1.title');
		$seller->description=$request->input('data1.description');
		$seller->city=$request->input('data2.locality');
		$seller->country=$request->input('data2.country');
		$seller->state=$request->input('data2.administrative_area_level_1');
		$seller->year_in_business=$request->input('data1.year_in_business');
		//$seller->locality=$request->input('data2.locality');
		$seller->phone_number=$request->input('data2.phone_number');
		$seller->area_code=$request->input('data2.area_code');
		$seller->postal_code=$request->input('data2.postal_code');
		$seller->website=$request->input('data2.website');
		$seller->vision_statement=$request->input('data2.vision_statement');
		$seller->mission_statement=$request->input('data2.mission_statement');
		$seller->tax_id=$request->input('data2.tax_id');
		$seller->pic=$name;
		$seller->post_type='seller';
	    $user = JWTAuth::parseToken()->authenticate();
	    $seller->user_id = $user->id;	
		$seller->updated_by = $user->full_name;	
			 
	    $seller->save();
			if ($seller->save()) {
                $success =trans('users/message.success.create');
            activity($seller->updated_by)
                ->performedOn($seller)
                ->causedBy($seller)
                ->log('Seller Add a Company by '.$seller->updated_by);
            // Redirect to the home page with success menu
           
			}
		$sellerId = $seller->id;
		$seller = Seller::where('id',$sellerId)->first();
		
		
		$user = JWTAuth::parseToken()->authenticate();
		$admin_email=Settings::pluck('admin_email');
		$admin=$admin_email[0];
		
		 $data = array('seller'=>$seller, 'user'=>$user);
		Mail::send('emails.seller', $data , function($message) use($admin)
		{
			$message->to($admin)->subject('Welcome!');
		});
			
	
			
	    return response()->json(['message' => 'You have registered successfully.']);
       
		 //return response()->json(['message' => 'You have registered successfully']);
    }

    public function donation_list()
	
	{
		$user = JWTAuth::parseToken()->authenticate();
		
		
		$pendingstatus=Donation::select('gs_donation.created_at','gs_donation.id','gs_donation.progress','gs_donation.units','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_status','0')->where('gs_donation.seller_id',$user->id)->paginate(request('pageLength'));
		//return($pendingstatus);
		
		$pendingLength=Donation::select('gs_donation.created_at','gs_donation.progress','gs_donation.units','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_status','0')->where('gs_donation.seller_id',$user->id)->count();
		
		$acceptstatus=Donation::select('gs_donation.created_at','gs_donation.progress','gs_donation.units','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_status','1')->where('gs_donation.is_certify','0')->where('gs_donation.seller_id',$user->id)->paginate(request('pageLength'));
		
		$acceptLength=Donation::select('gs_donation.created_at','gs_donation.progress','gs_donation.units','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_status','1')->where('gs_donation.is_certify','0')->where('gs_donation.seller_id',$user->id)->count();
		
		
		$declinestatus=Donation::select('gs_donation.created_at','gs_donation.progress','gs_donation.units','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_status','2')->where('gs_donation.seller_id',$user->id)->paginate(request('pageLength'));
		
		$declineLength=Donation::select('gs_donation.created_at','gs_donation.progress','gs_donation.units','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_status','2')->where('gs_donation.seller_id',$user->id)->count();
		
		$completestatus=Donation::select('gs_donation.created_at','gs_donation.progress','gs_donation.units','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_status','2')->where('gs_donation.is_certify','1')->where('progress','100')->where('gs_donation.seller_id',$user->id)->paginate(request('pageLength'));
		
		$completeLength=Donation::select('gs_donation.created_at','gs_donation.progress','gs_donation.units','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_status','2')->where('gs_donation.is_certify','1')->where('progress','100')->where('gs_donation.seller_id',$user->id)->count();
	
		
		
		
	return response()->json(array('data1'=>$pendingstatus,'data2'=>$acceptstatus,'data3'=>$declinestatus,'data4'=>$completestatus,'data5'=>$pendingLength,'data6'=>$acceptLength,'data7'=>$declineLength,'data8'=>$completeLength));
			
		
	}
  
  	 public function edit_donation(Request $request,$id)
    {
		
		$donation = Donation::find($id);
		return ($donation);	
    }
	public function updatedonation(Request $request,$id)
	{
	$donation=Donation::find($id);
	$donation->product=$request->get('product');
	$donation->units=$request->get('units');

	$donation->save();
	return response()->json(['message' => 'Data update Successfully']);
	}
  
  
		 public function edit(Request $request,$id)
    {
		$seller_type=SellerCategory::all();
		$seller = Seller::find($id);
		$business_type = SellerCategory::where('id',$seller->business_type)->pluck('title');
		return response()->json(array('data1'=>$seller,'data2'=>$seller_type,'data3'=>$business_type[0]));	
    }
       
    public function updateSeller(Request $request,$id)
	{
		$validation = Validator::make($request->all(), [
		'avatar' => 'required|image'
		]);
		if ($validation->fails())
		return response()->json(['message' => $validation->messages()->first()],422);
		$seller = new Seller;
		if($seller->avatar && \File::exists($this->avatar_path.$seller->avatar))
		\File::delete($this->avatar_path.$seller->avatar);
		$extension = $request->file('avatar')->getClientOriginalExtension();
		$filename = uniqid();
		$file = $request->file('avatar')->move($this->avatar_path, $filename.".".$extension);
		$img = \Image::make($this->avatar_path.$filename.".".$extension);
		$img->resize(200, null, function ($constraint) {
		$constraint->aspectRatio();
		
	});
		$image_ads = Seller::find($id);
		        $img->save($this->avatar_path.$filename.".".$extension);
				
        $image_ads->pic = $filename.".".$extension;
        $image_ads->save();
	 return response()->json(['message' => 'Avatar updated!','profile' => $image_ads]);
    }
public function updatelogo(Request $request,$id)
	{
		$validation = Validator::make($request->all(), [
		'avatar' => 'required|image'
		]);
		if ($validation->fails())
		return response()->json(['message' => $validation->messages()->first()],422);
		$seller= new Seller;
		if($seller->avatar && \File::exists($this->avatar_path.$seller->avatar))
		\File::delete($this->avatar_path.$seller->avatar);
		$extension = $request->file('avatar')->getClientOriginalExtension();
		$filename = uniqid();
		$file = $request->file('avatar')->move($this->avatar_path, $filename.".".$extension);
		$img = \Image::make($this->avatar_path.$filename.".".$extension);
		$img->resize(200, null, function ($constraint) {
		$constraint->aspectRatio();
		
	});
		$image = Seller::find($id);
		        $img->save($this->avatar_path.$filename.".".$extension);
				
        $image->pic = $filename.".".$extension;
        $image->save();
	 return response()->json(['message' => 'Avatar updated!','profile' => $image]);
    }
    
   public function update(Request $request,$id)
    { 	
	
	
        $seller = Seller::find($id);

            $seller->title = $request->get('title');
            $seller->description = $request->get('description');
            //$seller->location = $request->get('location');
			$seller->year_in_business = $request->get('year_in_business');
			$seller->business_type = $request->get('business_type');
			$seller->city = $request->get('city');
			$seller->country = $request->get('country');
			$seller->state = $request->get('state');
			$seller->area_code=$request->get('area_code');
			$seller->postal_code = $request->get('postal_code');
			$seller->phone_number = $request->get('phone_number');
			$seller->website = $request->get('website');
			$seller->vision_statement = $request->get('vision_statement');
			$seller->mission_statement = $request->get('mission_statement');
			$seller->tax_id = $request->get('tax_id');

        $seller->save();
		
        return response()->json(['message' => 'Data update Successfully']);
        
	}

    /**
     * Show a list of all the deleted users.
     *
     * @return View
     */
    public function getDeletedseller()
    {
		$seller = Seller::onlyTrashed()->get();

        // Show the page
        return view('admin.deleted_seller', compact('seller'));
    }

 public function destroy_donation($id)
	{
		 $donation = Donation::find($id);
		 
			$donation->delete();

     return response()->json(['message' => 'Data Deleted Successfully']);
    
    }
  

    public function destroy($id)
	{
		 $seller = Seller::find($id);
      $seller->delete();

     return response()->json(['message' => 'Data Deleted Successfully']);
    
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
       
		$seller = Seller::find($id);
        return view('admin.seller.show',compact('seller'));
    }
    public function passwordreset( Request $request)
    {
       
    }

    public function lockscreen($id)
	{

        
}
}
