<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use\App\Http\Controllers\JoshController;
use App\CharityCategory;
use App\Http\Requests\CharityCategoryRequest;
use App\Http\Requests;
use Sentinel;
use Validator;
use Illuminate\Http\Request;

class CharityCategoryController extends JoshController
{

   
    public function index()
    {
         $charitycategories=CharityCategory::all();
		 return response()->json($charitycategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request  $request)
    {
       
	    
		$charitycategory = Validator::make($request->all(), [
            'title' => 'required',
			'parent_id'=>'required',
			'description'=>'required'
            
        ]);
		if($charitycategory->fails())
            return response()->json(['message' => $charitycategory->messages()->first()],422);
			$charitycategory=\App\CharityCategory::create([
			'title'=> request('title'),
			'description'=> request('description'),
			'parent_id'=> request('parent_id')
			
			]);
			
			
			
        $charitycategory->save();
		
        return response()->json(['message' => 'Data Record Successfully']);	
	
	
		
		
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  BlogCategory $blogCategory
     * @return Response
     */
    public function edit($id)
    {
		$charitycategories=CharityCategory::find($id);
		
        return view('admin.charitycategory.edit', compact('charitycategories'));
    }
	
	public function update(Request $request, $id)
	{
		request()->validate([
           
			'title' => 'required',
			'description'=>'required'
			
           
        ]);
		
		
	
	
		
		
       CharityCategory::find($id)->update($request->all());
        return redirect()->route('admin.charitycategory.index')
                        ->with('success','Update Record  successfully');
	}

    public function destroy($id)
    {
		//charity::destroy($id);
         CharityCategory::destroy($id);
        return redirect()->route('admin.charitycategory.index')
                        ->with('success','Record deleted successfully');
    }
}
