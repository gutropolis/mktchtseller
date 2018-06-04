<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\JoshController;
use App\Http\Requests\UserRequest;
use App\Users;
use App\Payments;
use App\Packages;
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


class PaymentsController extends JoshController
{

   

    public function index()
    {

        // Show the page
        return view('admin.payments.index', compact('payment'));
    }

    /*
     * Pass data through ajax call
     */
    /**
     * @return mixed
     */
    public function data()
    {
		
				
        $payment = Payments::get(['id', 'email', 'stripe_secret_key', 'stripe_publishable_key','currency','created_at']);
		

        return DataTables::of($payment)
            ->editColumn('created_at',function(Payments $payment) {
                return $payment->created_at->diffForHumans();
            })
            
            ->addColumn('actions',function($payment) {
                $actions = '<a href='. route('admin.payments.edit', $payment->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update package"></i></a>';
                
                   
                
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
        
        return view('admin.plans.create');
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
       
       
          
		 $charity= new \App\Packages;
			$charity->package_name = request('package_name');
			$charity->amount = request('amount');
			$charity->currency = request('currency');
			$charity->interval = request('interval');
			$charity->interval_count = request('interval_count');
			$charity->trial_period = request('trail');
			$charity->save();
			
            return Redirect::route('admin.plans.index')->with('success', trans('users/message.success.create'));
			}
        

       
    

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit()
    {
		
       $payments=Payments::all();

        // Show the page
        return view('admin.payments.edit', compact('payments'));
    }

    /**
     * User update form processing page.
     *
     * @param  User $user
     * @param UserRequest $request
     * @return Redirect
     */
    public function update(Request $request,$id)
    {
         Payments::find($id)->update($request->all());
        return redirect()->route('admin.payments.index')
                        ->with('success','Update plan successfully');
	}
   
   


   
}
