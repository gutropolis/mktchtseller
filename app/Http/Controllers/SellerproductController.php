<?php 
namespace App\Http\Controllers;



use App\Seller;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use App\Sellerproduct;
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

class SellerproductController extends Controller
{
	 protected $avatar_path = 'images/product/';
    /**
     * Show a list of all the users.
     *
     * @return View
     */

    public function index()
    {
		$user = JWTAuth::parseToken()->authenticate();
		 $query = SellerProduct::whereUserId($user->id);
		$sellerproduct = $query->get();
        return response()->json($sellerproduct);
    }

	
	 public function updateAvatar(Request $request,$id){
        $validation = Validator::make($request->all(), [
            'avatar' => 'required|image'
        ]);

        if ($validation->fails())
            return response()->json(['message' => $validation->messages()->first()],422);

       $sellerproduct = sellerproduct::find($id);
   

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
        $sellerproduct->image = $filename.".".$extension;
        $sellerproduct->save();

        return response()->json(['message' => 'Avatar updated!','profile' => $sellerproduct]);
    }

    public function removeAvatar(Request $request,$id){

         $sellerproduct = sellerproduct::find($id);

 
        if(!$sellerproduct->avatar)
            return response()->json(['message' => 'No avatar uploaded!'],422);

        if(\File::exists($this->avatar_path.$sellerproduct->avatar))
            \File::delete($this->avatar_path.$sellerproduct->avatar);

        $sellerproduct->avatar = null;
        $sellerproduct->save();

        return response()->json(['message' => 'Avatar removed!']);
    }
    /*
     * Pass data through ajax call
     */
    /**
     * @return mixed
     */
   
	public function search(Request $request)
	{		
		$keyword = request('asin_url'); 
		//$keyword1=request('title');
		$seller=sellerproduct::Where('asin_url', 'like', '%' . $keyword . '%')->get();
		
		//$seller=sellerproduct::Where('title', 'like', '%' . $keyword1 . '%')->get();
		
		
	  return response()->json($seller);
	  
	}
	public function search1(Request $request)
	{		
		//$keyword = request('asin_url'); 
		$keyword1=request('title');
		//$seller=sellerproduct::Where('asin_url', 'like', '%' . $keyword . '%')->get();
		
		$seller=sellerproduct::Where('title', 'like', '%' . $keyword1 . '%')->get();
		
		
	  return response()->json($seller);
	  
	}
	
	public function product_details(Request $request,$id)
    {

        // Show the page
		$product_details=sellerproduct::find($id);
        return response()->json($product_details);
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
		
		$sellerproduct = \App\Sellerproduct::create([
            'title' => request('name'),
            'description' => request('description'),
            'asin_url' => request('ASIN'),
			'images' => request('image'),
			'reviews' => request('reviews'),
			'units'=> request('units'),
			
        ]);
		
		
	   
        
		$user = JWTAuth::parseToken()->authenticate();
		$query= Seller::where('user_id',$user->id)->first();
		$sellerproduct->organisation_id=$query->id;
		
		 $sellerproduct->user_id = $user->id;	
	  $sellerproduct->updated_by=$user->first_name;
       $sellerproduct->save();
	   
       
		 return response()->json(['message' => 'You have registered successfully']);
    }
    

    

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
  
		 public function edit($id)
    {
		$sellerproduct = sellerproduct::find($id);
		return response()->json($sellerproduct);
   
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
		
       $sellerproduct=sellerproduct::find($id);
		$sellerproduct->title=$request->get('title');
		$sellerproduct->description=$request->get('description');
		$sellerproduct->asin_url=$request->get('asin_url');
		$sellerproduct->reviews=$request->get('reviews');
		
		$sellerproduct->save();
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

    
   public function destroy(Request $request, $id){
        $task = \App\Sellerproduct::find($id);

        if(!$task)
            return response()->json(['message' => 'Couldnot find task!'],422);

        $task->delete();

        return response()->json(['message' => 'Product deleted!']);
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
