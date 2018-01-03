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
 $charity = charity::latest()->paginate(5);
        return view('pages.charityfba',compact('charity'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // $charity = charity::all();
       // return response()->json($charity);
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
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
			 'image'=>'required'
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
	 public function edit(charity $charity)
    {
 
    }
    
    public function destroy($id)
	{
    
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
			
		$charity=charity::Where('location', 'like', '%' . $keyword . '%')->get();
		//return charity::paginate(4);
		return response()->json($charity);
		
	}

    public function postLockscreen(Request $request){
       
    }
}
