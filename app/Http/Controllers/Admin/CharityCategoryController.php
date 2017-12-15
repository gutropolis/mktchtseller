<?php

namespace App\Http\Controllers\Admin;

use\App\Http\Controllers\JoshController;
use App\CharityCategory;
use App\Http\Requests\CharityCategoryRequest;
use App\Http\Requests;

use Illuminate\Http\Request;

class CharityCategoryController extends JoshController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Grab all the blog category
        $charitycategories=CharityCategory::all();
        $charitycategory=CharityCategory::all()->where('parent_id','=','0');
        $subcategory=CharityCategory::all()->where('parent_id','>','0');
        //$charitycategories=CharityCategory::with('children')->get();
        
        return view('admin.charitycategory.index', compact('charitycategories','charitycategory','subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.charitycategory.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CharityCategoryRequest  $request)
    {
       
		
           request()->validate([
           
			'title' => 'required',
			'description'=>'required'
			
           
        ]);
		
		
	
	
		
		
        CharityCategory::create($request->all());
        return redirect()->route('admin.charitycategory.index')
                        ->with('success','New Record created successfully');
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
