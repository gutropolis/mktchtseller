<?php 
namespace App\Http\Controllers;
use App\Seller;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use App\Http\Controllers\JoshController;
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
class SellerproductController extends JoshController
{

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
	return response()->json($sellerproduct );
	}

/*
* Pass data through ajax call
*/
/**
* @return mixed
*/

	public function search(Request $request)
	{		
	
	$keyword=request('title');
	
	$sellerproduct=sellerproduct::Where('title', 'like', '%' . $keyword . '%')->get();
	return response()->json($sellerproduct);
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
	return response()->json(['message' => 'Your Data Are Stored']);
	}

	public function edit($id)
	{
	$sellerproduct = sellerproduct::find($id);
	return response()->json($sellerproduct);
	}

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