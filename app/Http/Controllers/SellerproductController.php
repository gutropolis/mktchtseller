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

    /**
     * Show a list of all the users.
     *
     * @return View
     */

    public function index()
    {
		$user = JWTAuth::parseToken()->authenticate();
		 $query = \App\SellerProduct::whereUserId($user->id);
		$sellerproduct = $query->get();
        return response()->json($sellerproduct);
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
	   
        if ($file = $request->file('pic')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/sellerproduct/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['images'] = $safeName;
        }
		
       
      $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'asin_url' => 'required',
			'reviews' => 'required'
			 
        ]);

        if($validation->fails())
            return response()->json(['message' => $validation->messages()->first()],422);
        $sellerproduct = new Sellerproduct($request->all());
		$user = JWTAuth::parseToken()->authenticate();
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
