<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\JoshController;
use App\Http\Requests\charityRequest;
use App\Charity;
use App\Sellerproduct;
use App\Donation;
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
 
		return response()->json($charity);
    }
	 public function charity_list_user()
    {
		$user = JWTAuth::parseToken()->authenticate();
	$query = Charity::whereUserId($user->id);
	$charity = $query->latest()->get();
		
 
		return $charity;
    }
	
	
	public function product(Request $request,$id)
    {
		$charity = Charity::find($id);
		$sellerproduct=new \App\Donation;
		$sellerproduct->product=$request->input('data.title');
		$sellerproduct->product_name=$request->input('product_name');
		$sellerproduct->units=$request->input('data.units');
		$user = JWTAuth::parseToken()->authenticate();
		$sellerproduct->seller_id = $user->id;
		$sellerproduct->status="0";
		$sellerproduct->is_certify="0";
		$sellerproduct->charity_organisation=$charity->title;
		$sellerproduct->owner_charity=$charity->updated_by;
		$sellerproduct->owner_id=$charity->user_id;
		$sellerproduct->seller=$user->first_name;
		$sellerproduct->save();
		return response()->json(['message' => 'Data Record Successfully']);
	/*$user_id=User::where('id',$charity->user_id)->pluck('id');
	

	if($sellerproduct->save())
	{
		
		$activity= new \App\Activity;
		$activity->from_id = $user->id;
		$activity->from_name=$user->first_name;
		$activity->description='Donate Product to '.$sellerproduct->charity_organisation;
		$activity->subject =$user->first_name . " Donate Product to ". $charity->updated_by. "Organization";
		$activity->subject_url= "App\Activity";
		
		$activity->to_name = $charity->updated_by;
		$activity->to_id=$user_id[0];
		$activity->save();
		
		
		
		
	}*/
		
			
			
			
		
		
		
    }
	public function product_name($id)
	{
		$product_name=Sellerproduct::where('id',$id)->pluck('title');
		foreach($product_name as $product)
		{
			return($product);
		}
		
	//return($product_name);
	}
	
	
	public function donaters()
	
	{
		
		$date = new \DateTime();
		$date->modify('-3 days');
		$formatted_date = $date->format('Y-m-d H:i:s');
		$donaters = Donation::where('created_at', '>',$formatted_date)->get();
		
		
		
		
		foreach($donaters as $donate)
		{
			$image=Sellerproduct::where('id',$donate->product_id)->get();
		}
		
		return response()->json(array('data1'=>$donaters,'data2'=>$image));	
			
		
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
			
			$charity=CharityCategory::where('parent_id','>','0')->get();
	 
			return response()->json($charity);
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
		//$charity->location=$request->input('data1.locality');
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
		$charity_type=CharityCategory::all();
		$charity = charity::find($id);
		return response()->json(array('data1'=>$charity,'data2'=>$charity_type));	
    }
	public function edit_status(Request $request,$id)
    {
		
		$status = Donation::find($id);
		$product=Sellerproduct::where('id',$status->product)->get();
		return response()->json(array('data1'=>$status,'data2'=>$product));
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

   
    public function getRestore($id)
    {
       
    }
	//
public  function detail(Request $request,$id)
	{
		$user = JWTAuth::parseToken()->authenticate();
		//update receiver_read message
		$update=Message::where('inbox_id',$id)->where('reciever_id',$user->id)->update(['reciever_read' => 1 ]);
		
		
		
		$messages=Message::where('inbox_id',$id)->get();
		$msgInbox=array();
		foreach($messages as $message)
		{
			$user=User::where('id',$message->sender_id)->get();
			$userArr = array();
			$userArr['sender_detail']=$user;
			$message['sender_detail']=$user;
			array_push($msgInbox,$message);
		}
		return response()->json($msgInbox);
	}
	//
    
    public function notification()
    {
		$user = JWTAuth::parseToken()->authenticate();
	//$query = Donation::whereUserId($user->id);
	$date = new \DateTime();
		$date->modify('-3 days');
		$formatted_date = $date->format('Y-m-d H:i:s');
		
       $product=Donation::where('status','0')->whereOwnerId($user->id)->where('created_at', '>',$formatted_date)->orwhere('status','1')->get();
	   
	   $msgproduct=array();
		foreach($product as $pro)
		{
			$product_detail=Sellerproduct::where('id',$pro->product)->whereUserId($pro->seller_id)->first();
			//return($product_detail);
			$prodArr=array();
			$prodArr['product_detail']=$product;
			$product_detail['product_detail']=$product;
			array_push($msgproduct,$product_detail);
	 
		}
		
		return response()->json($msgproduct);
	}

    public function update_donation($id)
    {
       $donation = Donation::where('product',$id)->update(['status' => 1]);
		return response()->json(['message' => 'Product are Accepted']);
    }
	 public function reject_donation($id)
    {
       $donation = Donation::where('product',$id)->update(['status' => 2]);
		return response()->json(['message' => 'Product are Rejected']);
    }

    public function lockscreen($id)
	{

        
    }
	public function search(Request $reguest)
	{
		
		
		$keyword=request('searchlocation');
		$keyword1=request('searchcategory');
		
			//return response()->json($keyword);
		$charity=charity::Where('location', $keyword)->orwhere('charity_type',$keyword1)->get();
		
		//return charity::paginate(4);
		return response()->json($charity);
		
	}

    public function postLockscreen(Request $request){
       
    }
}
