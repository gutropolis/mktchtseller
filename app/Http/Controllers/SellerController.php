<?php namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use App\Http\Requests\SellerRequest;
use App\Seller;
use App\Donation;
use App\Http\Requests;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use App\SellerCategory;
use Illuminate\Http\Request;
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
		$seller=Seller::where('user_id',$user->id)->latest()->get();
 
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
		$seller->business_type=$request->input('data.business_type');
		$seller->title = $request->input('data.title');
		$seller->description=$request->input('data.description');
		$seller->location=$request->input('data.location');
		
		$seller->year_in_business=$request->input('data.year_in_business');
		$seller->address=$request->input('data.address');
		$seller->address=$request->input('data.address');
		$seller->phone_number=$request->input('data.phone_number');
		$seller->keywords=$request->input('data.keywords');
		$seller->vision_statement=$request->input('data.vision_statement');
		$seller->mission_statement=$request->input('data.mission_statement');
		$seller->tax_id=$request->input('data.tax_id');
		$seller->pic=$name;
		$seller->post_type='seller';
	    $user = JWTAuth::parseToken()->authenticate();
	    $seller->user_id = $user->id;	
		$seller->updated_by = $user->first_name;	

	    $seller->save();
	   
       
		 return response()->json(['message' => 'You have registered successfully']);
    }

    public function donation_list()
	
	{
		$user = JWTAuth::parseToken()->authenticate();
		$donaters=Donation::where('seller_id',$user->id)->get();
		return($donaters);
			
		
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
		return response()->json(array('data1'=>$seller,'data2'=>$seller_type));	
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

    
   public function update(Request $request,$id)
    { 	
	$validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
			'year_in_business' => 'required',
			
			'business_type' => 'required',
			'address' => 'required',
			'phone_number' => 'required',
			'keywords' => 'required',
			'vision_statement' => 'required',
			'mission_statement' => 'required',
			'tax_id' => 'required',
			
			
            
        ]);

        if($validation->fails())
            return response()->json(['message' => $validation->messages()->first()],422);
	
        $seller = Seller::find($id);

            $seller->title = $request->get('title');
            $seller->description = $request->get('description');
            $seller->location = $request->get('location');
			$seller->year_in_business = $request->get('year_in_business');
		
			$seller->business_type = $request->get('business_type');
			$seller->address = $request->get('address');
			$seller->phone_number = $request->get('phone_number');
			$seller->keywords = $request->get('keywords');
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
