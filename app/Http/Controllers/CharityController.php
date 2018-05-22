<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\charityRequest;
use App\Charity;
use App\Sellerproduct;
use App\Donation;
use App\Events\MessageDonation;
use App\User;
use App\CharityCategory;
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

    
class charityController extends Controller
{

 protected $avatar_path = 'images/charity/';   

		public function index()
		{
			
			$charityparcategory=CharityCategory::all();
				
			return response()->json($charityparcategory);
		}
		public function charites()
		{
		
			$charity=Charity::latest()->limit(6)->get();
			foreach ($charity as $char)
			{
			$category=CharityCategory::where('id',$char->charity_type)->pluck('title');
			}
	
			return response()->json(array('data1'=>$charity,'data2'=>$category[0]));
    }
	 public function charity_list()
		{
		
			$charity=Charity::all();
			foreach ($charity as $char)
			{
			$category=CharityCategory::where('id',$char->charity_type)->pluck('title');
			}
			return($charity);
			return response()->json(array('data1'=>$charity,'data2'=>$category[0]));
    }
	 public function charity_list_user(Request $request)
    {
		$user = JWTAuth::parseToken()->authenticate();
		$query = Charity::whereUserId($user->id);
			$charity = $query->latest()->paginate(request('pageLength'));

		return $charity;
    }
	public function charities_list()
	{		
	$user = JWTAuth::parseToken()->authenticate();

		$query = Charity::where('user_id',$user->id)->get();
		return response()->json($query);
	}
	public function all_charities()
	{
		$charity=Charity::get();
		return($charity);
		
	}
	
	public function fetch_charity(Request $request)
	{		
			$user = JWTAuth::parseToken()->authenticate();
		$charity = Charity::where('user_id',$user->id)->get();
		return response()->json($charity);
	}
	
	public function product(Request $request,$id)
    { //dkjfh
		$charity = Charity::find($id);
		$user = JWTAuth::parseToken()->authenticate();
		$sellerproduct=new \App\Donation;
		$sellerproduct->seller_id = $user->id;
		$sellerproduct->product_id=$request->input('id');
		$sellerproduct->charity_id=$charity->id;
		$sellerproduct->post_id=$charity->id;
		$sellerproduct->charity_owner_id=$charity->user_id;
		$sellerproduct->units=$request->input('units');
		$sellerproduct->charity_status="0";
		$sellerproduct->is_certify="0";
		$sellerproduct->progress="0";
		
		$sender_user=User::where('id',$sellerproduct->seller_id)->first();
		
		
		$reciever_user=User::where('id',$sellerproduct->charity_owner_id)->first();
		$product=Sellerproduct::where('id',$sellerproduct->product_id)->first();
		
	 $data = array('sellerproduct'=>$sellerproduct, 'sender_user'=>$sender_user,'reciever_user'=>$reciever_user,'product'=>$product);
		 Mail::send('emails.donate', $data , function($message) use ($reciever_user)
		{
			$message->to($reciever_user->email)->subject('Donate!');
		});
		$sellerproduct->save();
		
		$actvity=new Controller;
	$actvity->AddUserActivityFeed($sellerproduct->seller_id,$sellerproduct->charity_owner_id,'charity','Invite to Donate Product',$sellerproduct->post_id,'/donaters');
	
	
	
		if ($sellerproduct->save()) {
                $success =trans('users/message.success.create');
            activity($sender_user->fullname)
                ->performedOn($sellerproduct)
                ->causedBy($sellerproduct)
                ->log('Invite Charity to Donate Product '.$product->title);
            
            return response()->json(['message' => 'You have successfully make an offer.']);
			}
		
		
		
		return response()->json(['message' => 'Your Request for Charity donation Submitted.Charity Will Respond you as Soon']);
		
    }
	public function product_name($id)
	{
		$product_name=Sellerproduct::where('id',$id)->first();
		
			return($product_name);
		
		
	//return($product_name);
	}
	
	
	public function donaters(Request $request)
	
	{
		$user = JWTAuth::parseToken()->authenticate();
		$date = new \DateTime();
		$date->modify('-3 days');
		$formatted_date = $date->format('Y-m-d H:i:s');
		
		$donaters=Donation::select('gs_donation.created_at','gs_donation.id','gs_donation.progress','gs_donation.units','gs_vender_product.updated_by as seller','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.is_certify','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_owner_id','=',$user->id)->where('gs_donation.charity_status','1')->where('gs_donation.created_at', '>',$formatted_date)->paginate(request('pageLength'));
		if(request('page') && request('pageLength'))
		{
		
		$donatersLength=Donation::select('gs_donation.created_at','gs_donation.id','gs_donation.progress','gs_donation.units','gs_vender_product.updated_by as seller','gs_vender_product.title as product','gs_charity_organisation.title as charity','gs_donation.is_certify','gs_donation.charity_status')->join('gs_charity_organisation','gs_donation.charity_id','=','gs_charity_organisation.id')->join('gs_vender_product','gs_donation.product_id','=','gs_vender_product.id')->where('gs_donation.charity_owner_id','=',$user->id)->where('gs_donation.charity_status','1')->where('gs_donation.created_at', '>',$formatted_date)->count();
		}
		//return($donatersLength);
		return response()->json(array('data1'=>$donaters,'data2'=>$donatersLength));
		
		
		
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
		$update=Donation::where('id',$id)->update(['charity_status'=>request('status')]);
		 return response()->json(['message' => 'Task updated!']);
		
		
	}
	    public function toggleStatus($id){
			 $ids = explode(",", $id);
			
			$task = Donation::find($ids);
		foreach($task as $tasks){
			
			 $tasks->is_certify = "1";
			 $tasks->save();
		}
       
       

        return response()->json(['message' => 'Donation Are Certified Completed']);
    }
	
	
	 public function charity_type()
		{
			 $charitycategory=CharityCategory::all();
			 
            
			$charitysubcategory=CharityCategory::where('parent_id','>','0')->get();
			return response()->json(array('data1'=>$charitycategory,'data2'=>$charitysubcategory));	
			
		}

	
	
   
    public function store(Request $request)
    {
       
         
		
			if($request->get('image'))
				{
					$image = $request->get('image');
					$image = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
					\Image::make($request->get('image'))->save(public_path('images/charity/').$image);
				}

		
		  $charity = new \App\Charity;
		  
		 $charity->charity_type=$request->input('data2.charity_type');
		$charity->title = $request->input('data2.title');
		$charity->description=$request->input('data2.description');
	
		
		$charity->country=$request->input('data1.country');
		$charity->state=$request->input('data1.administrative_area_level_1');
		$charity->city=$request->input('data1.locality');
		$charity->address=$request->input('data2.address');
		$charity->postal_code=$request->input('data1.postal_code');
		$charity->website=$request->input('data1.website');
		$charity->vision_statement=$request->input('data1.vision_statement');
		$charity->mission_statement=$request->input('data1.mission_statement');
		 $charity->address=$request->input('data6');
		$charity->area_code=$request->input('data5');
		$charity->phone_number= $request->input('data4');
		$charity->images=$image;
		$charity->post_type='charity';
		
		//$tag=array();
		foreach($request->data3 as $data  )
			{
				$tag[]=$data['text'];			
			}
			
			$tagsss=implode(" , ", $tag);
			$charity->tags=$tagsss;
			
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
           
           $charityId = $charity->id;
		$charity = Charity::where('id',$charityId)->first();
		
		
		$user = JWTAuth::parseToken()->authenticate();
		
		$admin_email=Settings::pluck('admin_email');
		$admin=$admin_email[0];
		 $data = array('charity'=>$charity, 'user'=>$user);
		Mail::send('emails.charity', $data , function($message) use($admin)
		{
			$message->to($admin)->subject('Welcome!');
		});
			}
	   
		
        return response()->json(['message' => 'Data Record Successfully']);
	}
	 public function edit(Request $request,$id)
    {
		
             $charityparcategory=CharityCategory::all();
             
		$charity = Charity::find($id);
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
		
		$status->charity_status=$request->get('status');
		$status->progress=$request->get('progress');
		
		$status->save();
	$actvity=new Controller;
	$actvity->AddUserActivityFeed($status->charity_owner_id,$status->seller_id,'Update Your Status of Donating Product',$status->post_id,'/donaters');
		
		return response()->json(['message' => 'Data update Successfully']);	
    }
	public function update(Request $request,$id)
    { 	
	
        $charity = Charity::find($id);


            $charity->title = $request->get('title');
			$charity->description = $request->get('description');
			$charity->country = $request->get('country');
			$charity->state= $request->get('state');
			$charity->area_code= $request->get('area_code');
			$charity->postal_code= $request->get('postal_code');
			$charity->city= $request->get('city');
			$charity->phone_number= $request->get('phone_number');
			$charity->website= $request->get('website');
			$charity->vision_statement= $request->get('vision_statement');
			$charity->mission_statement= $request->get('mission_statement');
			$charity->address=$request->get('address');
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
		$date = new \DateTime();
				$date->modify('-3 days');
				$formatted_date = $date->format('Y-m-d H:i:s');
				
		$user = JWTAuth::parseToken()->authenticate();
       $unread_notification=Donation::where('charity_read',0)->where('charity_status','0')->where('charity_owner_id',$user->id)->where('created_at', '>',$formatted_date)->count();
	  return response()->json($unread_notification);
    }
	

    
    public function notification()
    {
		$user = JWTAuth::parseToken()->authenticate();
	
			$date = new \DateTime();
				$date->modify('-3 days');
				$formatted_date = $date->format('Y-m-d H:i:s');
				
				
		$pending=Donation::select('gs_donation.created_at','gs_donation.id','gs_vender_product.images','gs_donation.units','gs_vender_product.title','gs_vender_product.updated_by as seller')->join('gs_vender_product','gs_vender_product.id','=','gs_donation.product_id')->join('gs_charity_organisation','gs_charity_organisation.id','=','gs_donation.charity_id')->where('gs_donation.created_at', '>',$formatted_date)->where('gs_donation.charity_status','0')->where('gs_donation.charity_owner_id',$user->id)->get();
		
				//return($pending);
		$accept=Donation::select('gs_donation.created_at','gs_donation.id','gs_vender_product.images','gs_donation.units','gs_vender_product.title','gs_vender_product.updated_by as seller')->join('gs_vender_product','gs_vender_product.id','=','gs_donation.product_id')->join('gs_charity_organisation','gs_charity_organisation.id','=','gs_donation.charity_id')->where('gs_donation.created_at', '>',$formatted_date)->where('gs_donation.charity_status','1')->where('gs_donation.charity_owner_id',$user->id)->get();
			
		$decline=Donation::select('gs_donation.created_at','gs_donation.id','gs_vender_product.images','gs_donation.units','gs_vender_product.title','gs_vender_product.updated_by as seller')->join('gs_vender_product','gs_vender_product.id','=','gs_donation.product_id')->join('gs_charity_organisation','gs_charity_organisation.id','=','gs_donation.charity_id')->where('gs_donation.created_at', '>',$formatted_date)->where('gs_donation.charity_status','2')->where('gs_donation.charity_owner_id',$user->id)->get();
				
		
		return response()->json(array('data1'=>$pending,'data2'=>$accept,'data3'=>$decline));
	}

    public function update_donation($id)
    {
	
       $donation = Donation::where('id',$id)->update(['charity_status' => 1,'charity_read' => 1]);
	   $donation_detail=Donation::where('id',$id)->first();
	   $product=Sellerproduct::where('id',$donation_detail->product_id)->first();
	   $reciever_user=User::where('id',$donation_detail->seller_id)->first();
	   $sender_user=User::where('id',$donation_detail->charity_owner_id)->first();
	   $charity_detail=Charity::where('id',$donation_detail->post_id)->first();
	 
	   	 $data = array('donation_detail'=>$donation_detail, 'charity_detail'=>$charity_detail,'reciever_user'=>$reciever_user);
		  
		  $admin_email=Settings::pluck('admin_email');
		$admin=$admin_email[0];
		 
		Mail::send('emails.accept_donation', $data , function($message) use($admin)
		{
			$message->to($admin)->subject('Welcome!');
		});
		Mail::send('emails.accept_donation', $data , function($message) use ($reciever_user)
		{
			$message->to($reciever_user->email)->subject('Notify!');
		});
		/*$inbox=new \App\Inbox;
		$inbox->sender_id = $sender_user->id;
		$inbox->reciever_id = $reciever_user->id;
		$inbox->post_id = $donation_detail->product_id;
		$inbox->subject = $product->title;
		$inbox->status='0';
		$inbox->post_type='seller';
		$inbox->save();
		$message=new \App\Message;
		$message->inbox_id=$inbox->id;
		$message->sender_id=$sender_user->id;
		$message->reciever_id=$reciever_user->id;
		$message->message='Hello';
		$message->reciever_read='0';
		$message->save();*/
		
			$actvity=new Controller;
			$actvity->AddUserActivityFeed($donation_detail->charity_owner_id,$donation_detail->seller_id,'seller','Accept Donated product',$donation_detail->post_id,'/donaters');
			
		
	   
		return response()->json(['message' => 'You Have accepted The Product.Please Communicate with seller In Message section']);
    }
	 public function reject_donation($id)
    {
       $donation = Donation::where('id',$id)->update(['charity_status' => 2,'charity_read' => 1]);
	    $donation_detail=Donation::where('id',$id)->first();
	   $reciever_user=User::where('id',$donation_detail->seller_id)->first();
	   $charity_detail=Charity::where('id',$donation_detail->post_id)->first();
	   
	   	 $data = array('donation_detail'=>$donation_detail, 'charity_detail'=>$charity_detail,'reciever_user'=>$reciever_user);
		 
		 $admin_email=Settings::pluck('admin_email');
		$admin=$admin_email[0];
		 
		Mail::send('emails.reject_donation', $data , function($message) use($admin)
		{
			$message->to($admin)->subject('Welcome!');
		});
		 
		 
		
		 
		Mail::send('emails.reject_donation', $data , function($message) use ($reciever_user)
		{
			$message->to($reciever_user->email)->subject('Notify!');
			
			
		});
	   
	   $actvity=new Controller;
	$actvity->AddUserActivityFeed($donation_detail->charity_owner_id,$donation_detail->seller_id,'seller','Reject Donated product',$donation_detail->post_id,'/donaters');
		return response()->json(['message' => 'Product are Rejected']);
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
		
		$charity=$query->latest()->get();
		$charityArr=array();
		foreach($charity as $charities)
		{
			$category=CharityCategory::where('id',$charities->charity_type)->get();
			$categoryArr = array();
			$categoryArr['category']=$category;
			$charities['category']=$category;
			array_push($charityArr,$charities);
			
		}

		
	return response()->json($charityArr);
		
	}

    public function postLockscreen(Request $request){
       
    }
}
