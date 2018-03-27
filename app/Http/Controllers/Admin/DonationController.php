<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\JoshController;
use App\Http\Requests\SellerRequest;
use App\Donation;
use App\Sellerproduct;
use App\Charity;
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


class DonationController extends JoshController
{

    /**
     * Show a list of all the users.
     *
     * @return View
     */

    public function index(Request $request)
    {
		$donation = Donation::all();
		//echo $cms;
		//exit;
        // Show the page
        return view('admin.donation.index', compact('donation'));
    }

    /*
     * Pass data through ajax call
     */
    /**
     * @return mixed
     */
    public function donation_listData()
    {
		
		
        $donation = Donation::all();
		foreach($donation as $donate)
		{
		if($donate->status==0)
		{
			 $donate->status="pending";
			
		}
		elseif($donate->status==1){
			
			$donate->status="accept";
			
		}
		else{
			$donate->status="decline";
		}
		}         return DataTables::of($donation)
            ->editColumn('created_at',function(Donation $donation) {
                return $donation->created_at->format('d F Y ');
            })
             ->addColumn('actions',function($donation) {
                $actions = '<a href='. route('admin.donation.edit', $donation->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update donation"></i></a>';
                
                    $actions .= '<a href='. route('admin.donation.confirm-delete', $donation->id) .' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="donation-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete seller"></i></a>';
                
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
		
        return view('admin.cms.create',compact('cmscategory'));
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
		$cms = new cms($request->all());
	  $cms->updated_by = Sentinel ::getUser()->first_name;	
       $cms->save();
	   
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
				$donation=Donation::where('id',$id)->get();
                
                    foreach ($donation as $donate) {
                         $product=Sellerproduct::where('updated_by',$donate->seller)->get();
                          $charity=Charity::where('updated_by',$donate->owner_charity)->get();
                    }
              
              
               

        // Show the page\
                
        return view('admin.donation.edit', compact('donation','product','charity'));
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
  
        Donation::find($id)->update($request->all());
        return redirect()->route('admin.donation.index')
                        ->with('success','Update Donation  successfully');

    
	}
	
	

		
		
		

    public function getDeleteddonation()
    {
		$donation = Donation::onlyTrashed()->get();

        // Show the page
        return view('admin.deleted_donation', compact('donation'));
    }


    /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id)
    {
       $model = 'gs_donation';
        $confirm_route = $error = null;
       
        $confirm_route = route('admin.donation.delete', [$id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route')); 
    }

    
    public function destroy($id)
    {
        try {
            // Get seller information
            $donation =  Sentinel::findById($id);
            
            
           
            Donation::destroy($id);
           
            $success = trans('donation/message.success.delete');
                      
            return Redirect::route('admin.donation.index')->with('success', $success);
	} catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('admin/cms/message.donnation_not_found', compact('id'));

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
