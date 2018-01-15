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

    

    public function index()
    {
		
		$charityparcategory=CharityCategory::all();
 //$charityparcategory=CharityCategory::all()->where('parent_id','=','0');
       // $charitycategory=CharityCategory::all()->where('parent_id','>','0');
		//return response()->json(array('data1'=>$charityparcategory,'data2'=>$charitycategory));
		return response()->json($charityparcategory);
    }
	 public function charity_list()
    {
		
		$charity=charity::all();
 
		return response()->json($charity);
    }
 public function data()
    {
        $charity = charity::get(['id', 'title', 'description', 'location','created_at']);

        return DataTables::of($charity)
            ->editColumn('created_at',function(charity $charity) {
                return $charity->created_at->diffForHumans();
            })
            
            ->addColumn('actions',function($charity) {
                $actions = '<a href='. route('admin.charity.show', $charity->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                            <a href='. route('admin.charity.edit', $charity->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>';
                if ((Sentinel::getUser()->id != $charity->id) && ($charity->id != 1)) {
                    $actions .= '<a href='. route('admin.charity.confirm-delete', $charity->id) .' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>';
                }
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
	
	
	 public function updateAvatar(Request $request){
        $validation = Validator::make($request->all(), [
            'avatar' => 'required|image'
        ]);

        if ($validation->fails())
            return response()->json(['message' => $validation->messages()->first()],422);

        $charity = JWTAuth::parseToken()->authenticate();
        $profile = $charity->Profile;

        if($profile->avatar && \File::exists($this->avatar_path.$profile->avatar))
            \File::delete($this->avatar_path.$profile->avatar);

        $extension = $request->file('avatar')->getClientOriginalExtension();
        $filename = uniqid();
        $file = $request->file('avatar')->move($this->avatar_path, $filename.".".$extension);
        $img = \Image::make($this->avatar_path.$filename.".".$extension);
        $img->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($this->avatar_path.$filename.".".$extension);
        $profile->avatar = $filename.".".$extension;
        $profile->save();

        return response()->json(['message' => 'Avatar updated!','profile' => $profile]);
    }
   
    public function store(Request $request)
    {
       
         
		$charity = Validator::make($request->all(), [
            'charity_type'=>'required',
			
			'title' => 'required',
			'description'=>'required',
			'location'=>'required',
			'year_in_business'=>'required',
			'start_up_year'=>'required',
			'business_purpose'=>'required',
			'address'=>'required',
			'phone_number'=>'required',
			'keyword'=>'required',
			'vision_statement'=>'required',
			'mission_statement'=>'required',
			'tags'=>'required'
            
        ]);
		if($charity->fails())
            return response()->json(['message' => $charity->messages()->first()],422);
			$charity=\App\charity::create([
			'title'=> request('title'),
			'description'=> request('description'),
			'location'=> request('location'),
			'year_in_business'=> request('year_in_business'),
			'start_up_year'=> request('start_up_year'),
			'business_purpose'=> request('business_purpose'),
			'address'=> request('address'),
			'phone_number'=> request('phone_number'),
			'keyword'=> request('keyword'),
			'vision_statement'=> request('vision_statement'),
			'mission_statement'=> request('mission_statement'),
			'tags'=> request('tags'),
			'charity_type'=> request('charity_type')
			
			]);
			
			
			
        $charity->save();
		
        return response()->json(['message' => 'Data Record Successfully']);
	}
	public function update(Request $request,$id)
    { 	
	
        $charity = charity::find($id);

            $charity->title = $request->get('title');
			$charity->description = $request->get('description');
			$charity->location = $request->get('location');
			$charity->year_in_business= request('year_in_business');
			$charity->start_up_year= request('start_up_year');
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
    

    /**
     * User update form processing page.
     *
     * @param  charity $user
     * @param charityRequest $request
     * @return Redirect
     */
	  public function create()
    {
		

    }
	 public function edit(Request $request,$id)
    {
		$charity_type=CharityCategory::all();
		$charity = charity::find($id);
		return response()->json(array('data1'=>$charity,'data2'=>$charity_type));	
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
