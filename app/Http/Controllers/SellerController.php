<?php namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use App\Http\Requests\SellerRequest;
use App\Seller;
use App\Donation;
use App\Sellerproduct;
use App\Units;
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
		$units=new \App\Units;
		$user = JWTAuth::parseToken()->authenticate();
		$units->charity_id=$request->input('data.title');
		$units->product=$sellerproduct->title;
		$units->image=$sellerproduct->images;
		$units->charity_owner=$user->full_name;
		$units->units=$request->input('data.units');
		
		$units->charity_name=$request->input('charity_name');
		$units->product_id = $sellerproduct->id;
		$units->status="0";
		
		$units->save();

		
		

		
		
		return response()->json(['message' => 'Data Record Successfully']);
	
		
    }
	public function update_request($id)
    {
       $unit = Units::where('id',$id)->update(['status' => 1]);
		return response()->json(['message' => 'Product are Accepted']);
    }
	 public function reject_request($id)
    {
       $donation = Units::where('id',$id)->update(['status' => 2]);
		return response()->json(['message' => 'Product are Rejected']);
    }

		public function charity_name($id)
	{
		$charity_name=Charity::where('id',$id)->pluck('title');
		foreach($charity_name as $charity)
		{
			return($charity);
		}
	}
	public function units(){
			$units=Units::where('status',0)->orwhere('status','1')->get();
		$msgInbox=array();
		foreach($units as $unit)
		{
			$charity=Charity::where('id',$unit->charity_id)->get();
			$userArr = array();
			$userArr['sender_detail']=$charity;
			$unit['sender_detail']=$charity;
			array_push($msgInbox,$unit);
		}
			return response()->json($msgInbox);
		
		
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
	 public function seller_list()
    {

	
		$user = JWTAuth::parseToken()->authenticate();
		$query = Seller::whereUserId($user->id);
		$seller = $query->latest()->get();
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
		$seller->location=$request->input('data2.locality');
		
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
		$pending=Donation::where('seller_id',$user->id)->where('status','0')->get();
		
		$pendingstatus=array();
		foreach($pending as $pend)
		{
			
			$product=Sellerproduct::where('id',$pend->product_id)->pluck('title');
			//return($product[0]);
			$charity=Charity::where('id',$pend->charity_id)->pluck('title');
			$product_detail = array();
			$product_detail['product_detail']=$product;
			$product_detail['charity_detail']=$charity;
			
			$pend['product_detail']=$product;
			$pend['charity_detail']=$charity;
			array_push($pendingstatus,$pend);
			
		}
	
		$accept=Donation::where('seller_id',$user->id)->where('status','1')->where('is_certify','0')->get();
		$acceptstatus=array();
		foreach($accept as $acc)
		{
			
			$product=Sellerproduct::where('id',$acc->product_id)->pluck('title');
			//return($product[0]);
			$charity=Charity::where('id',$acc->charity_id)->pluck('title');
			$product_detail = array();
			$product_detail['product_detail']=$product;
			$product_detail['charity_detail']=$charity;
			
			$acc['product_detail']=$product;
			$acc['charity_detail']=$charity;
			array_push($acceptstatus,$acc);
			
		}
		
		$decline=Donation::where('seller_id',$user->id)->where('status','2')->get();
		$declinestatus=array();
		foreach($decline as $dec)
		{
			
			$product=Sellerproduct::where('id',$dec->product_id)->pluck('title');
			//return($product[0]);
			$charity=Charity::where('id',$dec->charity_id)->pluck('title');
			$product_detail = array();
			$product_detail['product_detail']=$product;
			$product_detail['charity_detail']=$charity;
			
			$dec['product_detail']=$product;
			$dec['charity_detail']=$charity;
			array_push($declinestatus,$dec);
			
		}
		$complete=Donation::where('seller_id',$user->id)->where('is_certify','1')->where('progress','100')->where('status','1')->get();
		$completestatus=array();
		foreach($complete as $comp)
		{
			
			$product=Sellerproduct::where('id',$comp->product_id)->pluck('title');
			//return($product[0]);
			$charity=Charity::where('id',$comp->charity_id)->pluck('title');
			$product_detail = array();
			$product_detail['product_detail']=$product;
			$product_detail['charity_detail']=$charity;
			
			$comp['product_detail']=$product;
			$comp['charity_detail']=$charity;
			array_push($completestatus,$comp);
			
		}
		
		
		
	return response()->json(array('data1'=>$pendingstatus,'data2'=>$acceptstatus,'data3'=>$declinestatus,'data4'=>$completestatus));
			
		
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
            $seller->location = $request->get('location');
			$seller->year_in_business = $request->get('year_in_business');
			$seller->business_type = $request->get('business_type');
			//$seller->locality = $request->get('locality');
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
