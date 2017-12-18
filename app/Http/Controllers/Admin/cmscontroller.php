<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\JoshController;
use App\Http\Requests\SellerRequest;
use App\cms;
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


class cmsController extends JoshController
{

    /**
     * Show a list of all the users.
     *
     * @return View
     */

    public function index(Request $request)
    {
		$cms=cms::all();
		//echo $cms;
		//exit;
        // Show the page
        return view('admin.cms.index', compact('cms'));
    }

    /*
     * Pass data through ajax call
     */
    /**
     * @return mixed
     */
    public function data()
    {		
        
		
       
    }

    /**
     * Create new user
     *
     * @return View
     */
    public function create()
    {
		
        return view('admin.cms.create',compact('cmscategory'));
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
	  
        cms::create($request->all());
		return redirect()->route('admin.cms.index')
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
				$cms=cms::all();
        // Show the page
        return view('admin.cms.edit', compact('cms'));
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
  
        cms::find($id)->update($request->all());
        return redirect()->route('admin.cms.index')
                        ->with('success','Update cms  successfully');

    
	}
	
	
	public function slug($str) {
    $str = strtolower(trim($str));
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', "-", $str);
    return rtrim($str, '-');
}

	public function get_one_value($con,$query) {
			$result = mysqli_query($con,$query);
			$row = mysqli_fetch_row($result);
			return($row[0]);
			$slug = slug($input_without_trailing_number);
		$exists = get_one_value("select count(id) from table where slug = '$slug'"); 

		if ($exists > 0)
		{
			$new_number = $exists + 1;
			$newslug = $slug."-".$new_number;
		}
		echo $newslug;
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


    /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id)
    {
       $model = 'gs_cms';
        $confirm_route = $error = null;
       
        $confirm_route = route('admin.cms.delete', [$id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route')); 
    }

    
    public function destroy($id)
    {
        try {
            // Get seller information
            $cms = Sentinel::findById($id);
            
            
           
            cms::destroy($id);
           
            $success = trans('cms/message.success.delete');
                      
            return Redirect::route('admin.cms.index')->with('success', $success);
	} catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('admin/cms/message.seller_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.cms.index')->with('error', $error);
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
       
		$cms = cms::find($id);
        return view('admin.cms.show',compact('cms'));
    }
    public function passwordreset( Request $request)
    {
       
    }

    public function lockscreen($id)
	{

        
}
}
