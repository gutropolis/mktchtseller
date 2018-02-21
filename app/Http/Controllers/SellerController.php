<?php namespace App\Http\Controllers;

use App\Http\Controllers\JoshController;
use App\Http\Requests\SellerRequest;
use App\Seller;
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
		
		$seller=Seller::all();
 
		return response()->json($seller);
    }
    public function data()
    {		
        $seller = Seller::get(['id','title', 'description', 'location', 'year_in_business','created_at']);
		
        return DataTables::of($seller)
            ->editColumn('created_at',function(Seller $seller) {
                return $seller->created_at->diffForHumans();
            })
           
	
            ->addColumn('actions',function($seller) {
                $actions = '<a href='. route('admin.seller.show', $seller->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view seller"></i></a>
                            <a href='. route('admin.seller.edit', $seller->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update seller"></i></a>';
                if ((Sentinel::getUser()->id != $seller->id) && ($seller->id != 1)) {
                    $actions .= '<a href='. route('admin.seller.confirm-delete', $seller->id) .' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="seller-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete seller"></i></a>';
                }
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
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
		
        if ($file = $request->file('pic_file')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/seller/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['pic'] = $safeName;
        }
		 $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
			'year_in_business' => 'required',
			'start_up_year' => 'required',
			'business_type' => 'required',
			'address' => 'required',
			'phone_number' => 'required',
			'keyword' => 'required',
			'vision_statement' => 'required',
			'mission_statement' => 'required',
			'tax_id' => 'required',
			
			
            
        ]);

        if($validation->fails())
            return response()->json(['message' => $validation->messages()->first()],422);
       $seller = \App\Seller::create([
            'title' => request('title'),
            'description' => request('description'),
            'location' => request('location'),
			'year_in_business' => request('year_in_business'),
			'start_up_year' => request('start_up_year'),
			'business_type' => request('business_type'),
			'address' => request('address'),
			'phone_number' => request('phone_number'),
			
			'vision_statement' =>request('vision_statement'),
			'mission_statement' => request('mission_statement'),
			'tax_id' => request('tax_id'),
			'post_type'=>'seller',
			
        ]);
	   $user = JWTAuth::parseToken()->authenticate();
		 $seller->user_id = $user->id;	
		 $seller->updated_by = $user->first_name;	

	    $seller->save();
	   
       
		 return response()->json(['message' => 'You have registered successfully']);
    }

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
  
		 public function edit(Request $request,$id)
    {
		$seller_type=SellerCategory::all();
		$seller = Seller::find($id);
		return response()->json(array('data1'=>$seller,'data2'=>$seller_type));	
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
	
        $seller = Seller::find($id);

            $seller->title = $request->get('title');
            $seller->description = $request->get('description');
            $seller->location = $request->get('location');
			$seller->year_in_business = $request->get('year_in_business');
			$seller->start_up_year= $request->get('start_up_year');
			$seller->business_type = $request->get('business_type');
			$seller->address = $request->get('address');
			$seller->phone_number = $request->get('phone_number');
			
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
