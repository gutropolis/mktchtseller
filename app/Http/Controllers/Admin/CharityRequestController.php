<?php

namespace App\Http\Controllers\Admin;

use\App\Http\Controllers\JoshController;
use App\my_ads;
use App\User;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use Sentinel;
use App\Http\Requests\ChRequest;


class CharityRequestController extends JoshController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       
		
		$request= my_ads::all();
		
		
        // Show the page
        return view('admin.charityrequests.index',compact('request'))->with('no', 1);
    
    }

	
	 public function data()
    {
        $request = my_ads::get(['id', 'title', 'description','images','created_at']);

        return DataTables::of($request)
            ->editColumn('created_at',function(request $request) {
                return $charity->created_at->diffForHumans();
            })
            
            ->addColumn('actions',function($request) {
                $actions = '<a href='. route('admin.charity.show', $charity->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                            <a href='. route('admin.charity.edit', $charity->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>';
                if ((Sentinel::getUser()->id != $charity->id) && ($charity->id != 1)) {
                    $actions .= '<a href='. route('admin.charity.confirm-delete', $charity->id) .' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>';
                }
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sellercategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ProductCategoryRequest $request)
    {
        $productCategory = new ProductCategory($request->all());
		 $productCategory->updated_by = Sentinel ::getUser()->first_name;

        if ($productCategory->save()) {
            return redirect('admin/productcategory')->with('success', trans('productcategory/message.success.create'));
        } else {
            return Redirect::route('admin/productcategory')->withInput()->with('error', trans('productcategory/message.error.create'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  BlogCategory $blogCategory
     * @return Response
     */
    public function edit($id)
    {
		$charityrequest= my_ads::find($id);
        return view('admin.charityrequests.edit', compact('charityrequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogCategory $blogCategory
     * @return Response
     */
 

    /**
     * Remove blog.
     *
     * @param BlogCategory $blogCategory
     * @return Response
     */
    public function getModalDelete(SellerCategory $sellerCategory)
    {
        $model = 'ProductCategory';
        $confirm_route = $error = null;
        try {
            $confirm_route = route('admin.productcategory.delete', ['id' => $productcategory->id]);
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        } catch (GroupNotFoundException $e) {

            $error = trans('productcategory/message.error.delete', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
    }
	
	  public function update(Request $request,$id)
    {
		if ($file = $request->file('image')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/images/charityads/';
            $safeName = str_random(10) . '.' . $extension;
   
            $file->move($destinationPath, $safeName);
            $request['image'] = $safeName;
   
   }
			
			$charity_request= my_ads::find($id);
			$charity_request->title=request('title');
			$charity_request->description=request('description');
			$charity_request->image=$safeName;
			$charity_request->save();
			$request= my_ads::all();
		   return view('admin.charityrequests.index',compact('request'))->with('no', 1);
    }
	
	
	public function accept($id)
    {
			$request=my_ads::where('id',$id)->first();
			
			
         $request->status='1';
		 $request->save();
		  
		 $user=User::where('id',$request->user_id)->pluck('email');
			$user_email=$user[0];
			 $data = array('request'=>$request,'user'=>$user );
		
		
		Mail::send('emails.acceptrequest', $data, function($message) use($user_email)
		{
			$message->to($user_email)->subject('Your request Activated');
		});
		 
		 
		 
		 
        return redirect()->route('admin.charityrequests.index')
                        ->with('success','Charity Request Activate successfully');
						
						
    }
	
	
	
	public function deactivate($id)
    {
			$request=my_ads::where('id',$id)->first();
			
         $request->status='0';
		 $request->save();
		  $user=User::where('id',$request->user_id)->pluck('email');
			$user_email=$user[0];
			 $data = array('request'=>$request,'user'=>$user );
		
		
		Mail::send('emails.deactivaterequest', $data, function($message) use($user_email)
		{
			$message->to($user_email)->subject('Your request Rejected');
		});
		 
        return redirect()->route('admin.charityrequests.index')
                        ->with('success','Charity Request Deactivate successfully');
    }
	
	
    /**
     * Remove the specified resource from storage.
     *
     * @param SellerCategory $blogCategory
     * @return Response
     */
    public function destroy($id)
    {
  //charity::destroy($id);
         my_ads::destroy($id);
        return redirect()->route('admin.charityrequests.index')
                        ->with('success','Request deleted successfully');
    }

}
