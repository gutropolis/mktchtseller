<?php 
namespace App\Http\Controllers;
use App\Seller;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use App\Http\Controllers\JoshController;
use App\Sellerproduct;
use App\Settings;
use App\ProductCategory;
use App\Charity;
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

class SellerproductController extends JoshController
{
protected $avatar_path = 'images/charityads/';

	public function index()
	{
	$user = JWTAuth::parseToken()->authenticate();
	$query = SellerProduct::whereUserId($user->id);
	$sellerproduct = $query->latest()->get();
	return response()->json($sellerproduct );
	}
	
		public function products()
	{
	
$sellerproduct = SellerProduct::latest()->limit(6)->get();
	return response()->json($sellerproduct );
	}

/*
* Pass data through ajax call
*/
/**
* @return mixed
*/

	
	public function product(Request $request)
	{		
	$user = JWTAuth::parseToken()->authenticate();
	$query = SellerProduct::whereUserId($user->id);
	$sellerproduct = $query->get();
	return response()->json($sellerproduct);
	}
	
	public function product_category()
	{
		$category=ProductCategory::all();
		return($category);
		return response()->json($category);
		
		
	}
	

	public function search(Request $request)
	{		
	

	$keyword=request('keyword');
		$product_category=request('product_category');
		$searchcategory=request('searchcategory');
	$keyword=request('keyword');
	
		
		/* Search Parameter */
					
			$query = Sellerproduct::query();

			// From Laravel 5.4 you can pass the same condition value as a parameter
			$query->when(request('keyword', false), function ($q, $keyword) { 
				return  $q->where('title', 'LIKE', '%'. $keyword .'%');
			});
			$query->when(request('searchcategory', false), function ($q, $searchcategory) { 
				return    $q->where('product_category', $searchcategory);
			});
	
		
		
		/* end here  */
		
		
			//return response()->json($keyword);
		$sellerproduct=$query->latest()->get();

		
		//return charity::paginate(4);
		return response()->json($sellerproduct);
	}
	public function product_details(Request $request,$id)
	{
	// Show the page
	$product_details=sellerproduct::find($id);
	$product_category=ProductCategory::where('id',$product_details->product_category)->first();
	
	return response()->json(array('data1'=>$product_details,'data2'=>$product_category));
	}


	public function store(Request $request)
	{

            
	$sellerproduct = \App\Sellerproduct::create([
	'title' => request('name'),
	'description' => request('bulletPoints'),
	'description_url' => request('description'),
	'asin_url' => request('ASIN'),
	'images' => request('image'),
	'organisation_id'=>request('title'),
	'product_category'=>request('product_catgeory'),
	'units'=> request('units'),
	'tags' => request('tags'),
	
	]);
	
	$user = JWTAuth::parseToken()->authenticate();
	$query= Seller::where('user_id',$user->id)->first();
	
	$sellerproduct->user_id = $user->id;	
	$sellerproduct->updated_by=$user->full_name;
	$sellerproduct->post_type= 'seller';
	$sellerproduct->save();
	$sellerproductId = $sellerproduct->id;
	$sellerproduct = Sellerproduct::where('id',$sellerproductId)->first();
	$seller=Seller::where('id',$sellerproduct->organisation_id)->first();
	
	$user = JWTAuth::parseToken()->authenticate();
		$admin_email=Settings::pluck('admin_email');
		$admin=$admin_email[0];
		
		 $data = array('sellerproduct'=>$sellerproduct,'seller'=>$seller ,'user'=>$user);
		Mail::send('emails.sellerproduct', $data , function($message) use($admin)
		{
			$message->to($admin)->subject('Add Product!');
		});
	
	
	if ($sellerproduct->save()) {
                $success =trans('users/message.success.create');
            activity($sellerproduct->updated_by)
                ->performedOn($sellerproduct)
                ->causedBy($sellerproduct)
                ->log('Seller Add a Product by '.$sellerproduct->updated_by);
            
            return response()->json(['message' => 'You have registered successfully.']);
			}
	return response()->json(['message' => 'Your Data Are Stored']);
	}

	public function edit($id)
	{
	
	$sellerproduct = sellerproduct::find($id);
	
	$business_type = Seller::where('id',$sellerproduct->organisation_id)->pluck('title');
	//return($business_type);

	return response()->json(array('data1'=>$sellerproduct,'data2'=>$business_type[0]));		
	}

	public function update(Request $request,$id)
	{
	$sellerproduct=sellerproduct::find($id);
	$sellerproduct->title=$request->get('title');
	$sellerproduct->description=$request->get('description');
	$sellerproduct->asin_url=$request->get('asin_url');
	$sellerproduct->organisation_id=$request->get('organisation_id');
	$sellerproduct->units=$request->get('units');
	$sellerproduct->tags=$request->get('tags');
	$sellerproduct->save();
	return response()->json(['message' => 'Data update Successfully']);
	}

	public function getDeletedseller()
	{
	$sellerproduct = Sellerproduct::onlyTrashed()->get();
	// Show the page
	return view('admin.deleted_sellerproduct', compact('sellerproduct'));
	}

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

	
}