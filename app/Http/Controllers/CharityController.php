<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\JoshController;
use App\Http\Requests\charityRequest;
use App\Charity;
use App\Sellerproduct;
use App\Donation;
use App\Events\MessageDonation;
use App\User;
use App\CharityCategory;
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


class charityController extends JoshController
{

 protected $avatar_path = 'images/charity/';   

		public function index()
		{
			
			$charityparcategory=CharityCategory::all();
				
			return response()->json($charityparcategory);
		}
	 public function charity_list()
		{
		
			$charity=Charity::all();
			foreach ($charity as $char)
			{
			$category=CharityCategory::where('id',$char->charity_type)->pluck('title');
			}
	
			return response()->json(array('data1'=>$charity,'data2'=>$category[0]));
    }
	 public function charity_list_user(Request $request)
    {
		$user = JWTAuth::parseToken()->authenticate();
		$query = Charity::whereUserId($user->id);
			$charity = $query->get();
		
		return response()->json($charity);
    }
	public function charities_list(Request $request)
	{		
	
		$query = Charity::all();
		return response()->json($query);
	}
	
	public function product(Request $request,$id)
    {
		$charity = Charity::find($id);
		$user = JWTAuth::parseToken()->authenticate();
		$sellerproduct=new \App\Donation;
		$sellerproduct->seller_id = $user->id;
		$sellerproduct->product_id=$request->input('data.id');
		$sellerproduct->charity_id=$charity->id;
		$sellerproduct->post_id=$charity->id;
		$sellerproduct->charity_owner_id=$charity->user_id;
		$sellerproduct->units=$request->input('data.units');
		$sellerproduct->status="0";
		$sellerproduct->is_certify="0";
		$sellerproduct->save();
		$seller=$sellerproduct->save();;
	
		return response()->json(['message' => 'Your Request for Charity donation Submitted.Charity Will Respond you as Soon']);
		
    }
	public function product_name($id)
	{
		$product_name=Sellerproduct::where('id',$id)->first();
		
			return($product_name);
		
		
	//return($product_name);
	}
	
	
	public function donaters()
	
	{
		
		$date = new \DateTime();
		$date->modify('-3 days');
		$formatted_date = $date->format('Y-m-d H:i:s');
		$donaters = Donation::where('created_at', '>',$formatted_date)->get();
		
		$donatersdata=array();
		
		
		foreach($donaters as $donate)
		{
			$product=Sellerproduct::where('id',$donate->product_id)->get();
			$charity=Charity::where('id',$donate->charity_id)->get();
			$product_detail = array();
			$product_detail['product_detail']=$product;
			$product_detail['charity_detail']=$charity;
			
			$donate['product_detail']=$product;
			$donate['charity_detail']=$charity;
			array_push($donatersdata,$donate);
		}
		
		return response()->json($donatersdata);	
			
		
	}
		public function product_detail($id)
	
	{
		$product_detail=Sellerproduct::where('id',$id)->get();
		return($product_detail);
		
		return response()->json($product_detail);
		
		
	}
		
		
		
		
		
		public function status(Request $request,$id)
	
	{
		   $status = Donation::find($id);
		$update=Donation::where('id',$id)->update(['status'=>request('status')]);
		 return response()->json(['message' => 'Task updated!']);
		
		
	}
	    public function toggleStatus(Request $request,$id){
        $task = Donation::find($id);

        if(!$task)
            return response()->json(['message' => 'Couldnot find task!'],422);

        $task->is_certify = !$task->is_certify;
        $task->save();

        return response()->json(['message' => 'Task updated!']);
    }
	
	
	 public function charity_type()
		{
			 $charitycategory=CharityCategory::all();
			 
            
			$charitysubcategory=CharityCategory::where('parent_id','>','0')->get();
			return response()->json(array('data1'=>$charitycategory,'data2'=>$charitysubcategory));	
			
		}

	
	
   
    public function store(Request $request)
    {
       
         
		$charity = Validator::make($request->all(), [
           // 'charity_type'=>'required',
			
			'title' => 'required',
			'description'=>'required',
			'location'=>'required',
			'year_in_business'=>'required',
			
			'business_purpose'=>'required',
			'locality'=>'required',
			'postal_code'=> 'required',
			'phone_number'=>'required',
			'website'=>'required',
			'vision_statement'=>'required',
			'mission_statement'=>'required',
			'tags'=>'required'
            
        ]);
			if($request->get('image'))
				{
					$image = $request->get('image');
					$name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
					\Image::make($request->get('image'))->save(public_path('images/charity/').$name);
				}

		
		  $charity = new \App\Charity;
		 $charity->charity_type=$request->input('data2.charity_type');
		$charity->title = $request->input('data2.title');
		$charity->description=$request->input('data2.description');
		//$charity->location=$request->input('data2.location');
		$charity->business_purpose=$request->input('data1.business_purpose');
		$charity->year_in_business=$request->input('data2.year_in_business');
		$charity->location=$request->input('data1.locality');
		$charity->years_inception=$request->input('data1.years_inception');
		//$charity->address =$request->input('data1.addr');
		$charity->postal_code=$request->input('data1.postal_code');
		$charity->website=$request->input('data1.website');
		$charity->vision_statement=$request->input('data1.vision_statement');
		$charity->mission_statement=$request->input('data1.mission_statement');
		$charity->tags=$request->input('data1.tags'); 
		$charity->area_code=$request->input('data1.area_code');
		$charity->phone_number= $request->input('data1.phone_number');
		$charity->images=$name;
		$charity->post_type='charity';
			
			$user = JWTAuth::parseToken()->authenticate();
			$charity->user_id = $user->id; 
			$charity->updated_by= $user->full_name; 
		  //$charity->updated_by = $user->first_name;
			
        $charity->save();
		if ($charity->save()) {
                $success =trans('users/message.success.create');
            activity($charity->updated_by)
                ->performedOn($charity)
                ->causedBy($charity)
                ->log('Charity Organisation Add Organisation by '.$charity->updated_by);
            // Redirect to the home page with success menu
            return response()->json(['message' => 'You have registered successfully.']);
			}
	   
		
        return response()->json(['message' => 'Data Record Successfully']);
	}
	 public function edit(Request $request,$id)
    {
		
             $charityparcategory=CharityCategory::all();
             
		$charity = charity::find($id);
		$charity_type = CharityCategory::where('id',$charity->charity_type)->pluck('title');
		
		return response()->json(array('data1'=>$charity,'data2'=>$charityparcategory,'data3'=>$charity_type[0]));	
    }
	public function edit_status(Request $request,$id)
    {
		
		$status = Donation::find($id);
		$product=Sellerproduct::where('id',$status->product_id)->first();
		$charity=Charity::where('id',$status->charity_id)->first();
		
		return response()->json(array('data1'=>$status,'data2'=>$product,'data3'=>$charity));
    }
	public function update_status(Request $request,$id)
    {
		
		$status = Donation::find($id);
		
		$status->status=$request->get('status');
		
		$status->save();
		
		return response()->json(['message' => 'Data update Successfully']);	
    }
	public function update(Request $request,$id)
    { 	
	
        $charity = Charity::find($id);


            $charity->title = $request->get('title');
			$charity->description = $request->get('description');
			$charity->location = $request->get('location');
			$charity->year_in_business= $request->get('year_in_business');
			$charity->area_code= $request->get('area_code');
			$charity->postal_code= $request->get('postal_code');
			$charity->business_purpose= $request->get('business_purpose');
			$charity->years_inception= $request->get('years_inception');
			
			$charity->phone_number= $request->get('phone_number');
			$charity->website= $request->get('website');
			$charity->vision_statement= $request->get('vision_statement');
			$charity->mission_statement= $request->get('mission_statement');
			$charity->tags= $request->get('tags');
			$charity->charity_type= $request->get('charity_type');

        $charity->save();
		
        return response()->json(['message' => 'Data update Successfully']);
        
	}
    
	
	 public function updateCharity(Request $request,$id)
	{
		$validation = Validator::make($request->all(), [
		'avatar' => 'required|image'
		]);
		if ($validation->fails())
		return response()->json(['message' => $validation->messages()->first()],422);
		$charity = new Charity;
		if($charity->avatar && \File::exists($this->avatar_path.$seller->avatar))
		\File::delete($this->avatar_path.$charity->avatar);
		$extension = $request->file('avatar')->getClientOriginalExtension();
		$filename = uniqid();
		$file = $request->file('avatar')->move($this->avatar_path, $filename.".".$extension);
		$img = \Image::make($this->avatar_path.$filename.".".$extension);
		$img->resize(200, null, function ($constraint) {
		$constraint->aspectRatio();
		
	});
		$image = Charity::find($id);
		        $img->save($this->avatar_path.$filename.".".$extension);
				
        $image->images = $filename.".".$extension;
        $image->save();
	 return response()->json(['message' => 'Avatar updated!','profile' => $image]);
    }
	
	public function charity_details(Request $request,$id=1)
    {
		//$charity_details=CharityCategory::all();
		$charity_details = Charity::find($id);
		return response()->json($charity_details);	
    }
	
    
    public function destroy($id)
	{
		 $charity = Charity::find($id);
      $charity->delete();

     return response()->json(['message' => 'Data Deleted Successfully']);
    
    }
	
	public function getModalDelete($id)
    {
    }

   
    public function unread_notification()
    {
       $unread_notification=Donation::where('charity_read',0)->count();
	  return response()->json($unread_notification);
    }
	

    
    public function notification()
    {
		$user = JWTAuth::parseToken()->authenticate();
	
			$date = new \DateTime();
				$date->modify('-3 days');
				$formatted_date = $date->format('Y-m-d H:i:s');
		
       $product=Donation::where('status','0')->where('charity_owner_id',$user->id)->where('created_at', '>',$formatted_date)->get();
	  
	   $detail=array();
		foreach($product as $pro)
		{
			
			$product=Sellerproduct::where('id',$pro->product_id)->get();
			
			$charity=Charity::where('id',$pro->charity_id)->get();
			$product_detail = array();
			$product_detail['product_detail']=$product;
			$product_detail['charity_detail']=$charity;
			
			$pro['product_detail']=$product;
			$pro['charity_detail']=$charity;
			array_push($detail,$pro);
			
		}
		
		
		  $product=Donation::where('status','1')->where('charity_owner_id',$user->id)->where('created_at', '>',$formatted_date)->get();
		$acceptproduct=array();
		foreach($product as $pro)
		{
			
			$product=Sellerproduct::where('id',$pro->product_id)->get();
			
			$charity=Charity::where('id',$pro->charity_id)->get();
			$product_detail = array();
			$product_detail['product_detail']=$product;
			$product_detail['charity_detail']=$charity;
			
			$pro['product_detail']=$product;
			$pro['charity_detail']=$charity;
			array_push($acceptproduct,$pro);
			
		}
		$product=Donation::where('status','2')->where('charity_owner_id',$user->id)->where('created_at', '>',$formatted_date)->get();
		$declineproduct=array();
		foreach($product as $pro)
		{
			
			$product=Sellerproduct::where('id',$pro->product_id)->get();
			
			$charity=Charity::where('id',$pro->charity_id)->get();
			$product_detail = array();
			$product_detail['product_detail']=$product;
			$product_detail['charity_detail']=$charity;
			
			$pro['product_detail']=$product;
			$pro['charity_detail']=$charity;
			array_push($declineproduct,$pro);
			
		}
		return response()->json(array('data1'=>$detail,'data2'=>$acceptproduct,'data3'=>$declineproduct));
	}

    public function update_donation($id)
    {
	
       $donation = Donation::where('id',$id)->update(['status' => 1,'charity_read' => 1]);
		return response()->json(['message' => 'Product are Accepted']);
    }
	 public function reject_donation($id)
    {
       $donation = Donation::where('id',$id)->update(['status' => 2,'charity_read' => 1]);
		return response()->json(['message' => 'Product are Rejected']);
    }

    public function searchform(Request $reguest)
	{
		$keyword=request('keyword');
		return($keyword);
    }
	public function search(Request $reguest)
	{
	 
		$keyword=request('keyword');
		$charity_type=request('charity_type');
		$searchcategory=request('searchcategory');
		
		
		/* Search Parameter */
					
			$query = Charity::query();

			// From Laravel 5.4 you can pass the same condition value as a parameter
			$query->when(request('keyword', false), function ($q, $keyword) { 
				return  $q->where('title', 'LIKE', '%'. $keyword .'%');
			});
			$query->when(request('charity_type', false), function ($q, $charity_type) { 
				return    $q->where('charity_type',$charity_type)->get();
			});
	
		
		
		/* end here  */
		
		
			//return response()->json($keyword);
		$charity=$query->get();

		
		//return charity::paginate(4);
		return response()->json($charity);
		
	}

    public function postLockscreen(Request $request){
       
    }
}
