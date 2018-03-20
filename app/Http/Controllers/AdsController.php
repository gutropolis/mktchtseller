<?php 
namespace App\Http\Controllers;



use App\my_ads;
use App\charity;
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
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
//use JWTAuth;

class AdsController extends Controller
{

    /**
     * Show a list of all the users.
     *
     * @return View
     */

     public function index()
    {
		$user = JWTAuth::parseToken()->authenticate();
		 $query = \App\my_ads::whereUserId($user->id);
		$show_ads = $query->get();
		//$show_ads=my_ads::all();
        return response()->json($show_ads);
    }

	public function charity()
	{
		$user = JWTAuth::parseToken()->authenticate();
		$query=\App\charity::whereUserId($user->id);
		$qu=$query->get();
		return($qu);
		
		
		
		
		
		
		
	}
	public function updateAvatar(Request $request){
        $validation = Validator::make($request->all(), [
            'avatar' => 'required|image'
        ]);

        if ($validation->fails())
            return response()->json(['message' => $validation->messages()->first()],422);

       	$sellerproduct=Seller::all();

        if($sellerproduct->avatar && \File::exists($this->avatar_path.$sellerproduct->avatar))
            \File::delete($this->avatar_path.$sellerproduct->avatar);

        $extension = $request->file('avatar')->getClientOriginalExtension();
        $filename = uniqid();
        $file = $request->file('avatar')->move($this->avatar_path, $filename.".".$extension);
        $img = \Image::make($this->avatar_path.$filename.".".$extension);
        $img->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($this->avatar_path.$filename.".".$extension);
        $sellerproduct->avatar = $filename.".".$extension;
        $sellerproduct->save();

        return response()->json(['message' => 'Avatar updated!','profile' => $sellerproduct]);
    }

	
    /*
     * Pass data through ajax call
     */
    /**
     * @return mixed
     */
    public function data()
    {		
        $seller = Seller::get(['id','title', 'description', 'location', 'year_in_buisness','created_at']);
		
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
		
        return view('admin.sellerproduct.create');
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
					\Image::make($request->get('image'))->save(public_path('images/charityads/').$name);
				}
		
      
          $create_ads = new \App\my_ads;
		 $create_ads->title=$request->input('data.title');
		
		$create_ads->description=$request->input('data.description');
			$create_ads->location=$request->input('data.location');
		  $create_ads->ads_type=$request->input('data.ads_type');
		  
		$create_ads->image=$name;
		$user = JWTAuth::parseToken()->authenticate();
		 $create_ads->user_id = $user->id;	
	 
       $create_ads->save();
	   
       
		 return response()->json(['message' => 'Your Ads sucessfully Added']);
    }

    

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
  
		 public function edit($id)
    {
		$edit_ads = my_ads::find($id);
		return response()->json($edit_ads);
   
    }
      public function destroy($id)
	{
		 $ads = my_ads::find($id);
      $ads->delete();

     return response()->json(['message' => 'Data Deleted Successfully']);
    
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
		
       $ads_update=my_ads::find($id);
		$ads_update->title=$request->get('title');
		$ads_update->description=$request->get('description');
		$ads_update->image=$request->get('image');
		$ads_update->location=$request->get('location');
		$ads_update->ads_type=$request->get('ads_type');
		
		$ads_update->save();
     return response()->json(['message' => 'Data update Successfully']);

    
	}

    /**
     * Show a list of all the deleted users.
     *
     * @return View
     */
    public function getDeletedseller()
    {
		$sellerproduct = Sellerproduct::onlyTrashed()->get();

        // Show the page
        return view('admin.deleted_sellerproduct', compact('sellerproduct'));
    }


    /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id)
    {
       $model = 'gs_vendor_product';
        $confirm_route = $error = null;
       
        $confirm_route = route('admin.sellerproduct.delete', [$id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route')); 
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
