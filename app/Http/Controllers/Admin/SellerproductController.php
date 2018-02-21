<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\JoshController;
use App\Http\Requests\SellerRequest;
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
use App\Http\Requests;
use Amazon;
use Log;


class SellerproductController extends JoshController
{

 
    public function index()
    {
		
		$cms=Sellerproduct::all();
        // Show the page
        return view('admin.sellerproduct.index', compact('cms'));
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
    public function create(Request $request)
    {
		
		
        return view('admin.sellerproduct.create');
    }

    
    public function store(Request $request)
    {
	   
        if ($file = $request->file('pic')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/sellerproduct/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['images'] = $safeName;
        }
		
       
       $sellerproduct = new Sellerproduct($request->all());
	  $sellerproduct->updated_by = Sentinel ::getUser()->first_name;	
	  $sellerproduct->user_id=Sentinel:: getUser()->id;
       $sellerproduct->save();
		return redirect()->route('admin.sellerproduct.index')
		->with('success', 'new record created succesfullly');
    }

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
  
		 public function edit($id)
    {
		$cms=Sellerproduct::where('id',$id)->get();

        // Show the page
        return view('admin.sellerproduct.edit',compact('cms'));
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
         if ($file = $request->file('images')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/sellerproduct/';
            $safeName = str_random(10) . '.' . $extension;
   
            $file->move($destinationPath, $safeName);
            $request['images'] = $safeName;
   
   }
        
  
        Sellerproduct::find($id)->update($request->all());
        return redirect()->route('admin.sellerproduct.index')
                        ->with('success','Update Seller  successfully');

    
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

    
    public function destroy($id)
    {
        try {
            // Get seller information
            $seller = Sentinel::findById($id);
            
            
           
            Sellerproduct::destroy($id);
           
            $success = trans('seller/message.success.delete');
                      
            return Redirect::route('admin.sellerproduct.index')->with('success', $success);
	} catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('admin/sellerproduct/message.seller_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.sellerproduct.index')->with('error', $error);
        }
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
