<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\JoshController;
use App\Http\Requests\charityRequest;
use App\charity;
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
		
		$charity=charity::all();
 
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
			'address'=>'required',
			'phone_number'=>'required',
			'keyword'=>'required',
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


		
	

		
		  $charity = new \App\charity;
		  $charity->charity_type=$request->input('data.charity_type');
		$charity->title = $request->input('data.title');
		$charity->description=$request->input('data.description');
		$charity->location=$request->input('data.location');
		$charity->business_purpose=$request->input('data.business_purpose');
		$charity->year_in_business=$request->input('data.year_in_business');
		$charity->address=$request->input('data.address');
		$charity->address=$request->input('data.address');
		$charity->phone_number=$request->input('data.phone_number');
		$charity->keyword=$request->input('data.keyword');
		$charity->vision_statement=$request->input('data.vision_statement');
		$charity->mission_statement=$request->input('data.mission_statement');
		$charity->tags=$request->input('data.tags');
		$charity->images=$name;
		$charity->post_type='charity';
			
			$user = JWTAuth::parseToken()->authenticate();
			$charity->user_id = $user->id; 
			$charity->updated_by= $user->first_name; 
		  //$charity->updated_by = $user->first_name;
			
        $charity->save();
		
        return response()->json(['message' => 'Data Record Successfully']);
	}
	 public function edit(Request $request,$id)
    {
		$charity_type=CharityCategory::all();
		$charity = charity::find($id);
		return response()->json(array('data1'=>$charity,'data2'=>$charity_type));	
    }
	public function update(Request $request,$id)
    { 	
	
        $charity = charity::find($id);

            $charity->title = $request->get('title');
			$charity->description = $request->get('description');
			$charity->location = $request->get('location');
			$charity->year_in_business= request('year_in_business');
			
			$charity->business_purpose= request('business_purpose');
			$charity->address=request('address');
			$charity->phone_number= request('phone_number');
			$charity->keyword= request('keyword');
			$charity->vision_statement= request('vision_statement');
			$charity->mission_statement= request('mission_statement');
			$charity->tags=request('tags');
			$charity->charity_type= request('charity_type');

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
		$charity_details = charity::find($id);
		return response()->json($charity_details);	
    }
	
    
    public function destroy($id)
	{
		 $charity = charity::find($id);
      $charity->delete();

     return response()->json(['message' => 'Data Deleted Successfully']);
    
    }
	
	public function getModalDelete($id)
    {
    }

   
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
       
	}

    public function passwordreset( Request $request)
    {
       
    }

    public function lockscreen($id)
	{

        
    }
	public function search(Request $reguest)
	{
		
		
		$keyword=request('searchlocation');
			//return response()->json($keyword);
		$charity=charity::Where('location', 'like', '%' . $keyword . '%')->get();
		//return charity::paginate(4);
		return response()->json($charity);
		
	}

    public function postLockscreen(Request $request){
       
    }
}
