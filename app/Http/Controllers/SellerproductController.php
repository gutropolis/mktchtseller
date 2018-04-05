<?php 
namespace App\Http\Controllers;
use App\Seller;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use App\Http\Controllers\JoshController;
use App\Sellerproduct;
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
	
$sellerproduct = SellerProduct::latest()->get();
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
	
	public function productcategory()
	{
		$productcategory=ProductCategory::all();
		return response()->json($productcategory);
		
		
	}


	public function search(Request $request)
	{		
	
	$keyword=request('title');
	$keyword1=request('searchcategory');
	
	//$sellerproduct=sellerproduct::Where('title', 'like', '%' . $keyword . '%')->latest()->get();
	$product=Sellerproduct::where('product_category',$keyword1)->get();
	return response()->json($product);
	}
	public function product_details(Request $request,$id)
	{
	// Show the page
	$product_details=sellerproduct::find($id);
	return response()->json($product_details);
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
	//return($sellerproduct);
	//return($sellerproduct->productcategory);
	$user = JWTAuth::parseToken()->authenticate();
	$query= Seller::where('user_id',$user->id)->first();
	//$sellerproduct->organisation_id=$query->id;
	$sellerproduct->user_id = $user->id;	
	$sellerproduct->updated_by=$user->full_name;
	$sellerproduct->post_type= 'seller';
	$sellerproduct->save();
	if ($sellerproduct->save()) {
                $success =trans('users/message.success.create');
            activity($sellerproduct->updated_by)
                ->performedOn($sellerproduct)
                ->causedBy($sellerproduct)
                ->log('Seller Add a Product by '.$sellerproduct->updated_by);
            // Redirect to the home page with success menu
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