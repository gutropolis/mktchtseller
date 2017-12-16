<?php

namespace App\Http\Controllers\Admin;

use\App\Http\Controllers\JoshController;
use App\SellerCategory;
use App\Http\Requests;
use App\Http\Requests\SellerCategoryRequest;


class SellerCategoryController extends JoshController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sellercategories = SellerCategory::all();
		
		$subcategory= SellerCategory::all()->where('parent_id','>','0');
		
		$s = SellerCategory::all()->where('parent_id','=','0');
		
        // Show the page
        return view('admin.sellercategory.index', compact('sellercategories','s','subcategory'));
    
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
    public function store(SellerCategoryRequest $request)
    {
        $sellerCategory = new SellerCategory($request->all());

        if ($sellerCategory->save()) {
            return redirect('admin/sellercategory')->with('success', trans('sellercategory/message.success.create'));
        } else {
            return Redirect::route('admin/sellercategory')->withInput()->with('error', trans('sellercategory/message.error.create'));
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
		$sellercategory=SellerCategory::find($id);
        return view('admin.sellercategory.edit', compact('sellercategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogCategory $blogCategory
     * @return Response
     */
    public function update(SellerCategoryRequest $request, SellerCategory $sellercategory)
    {
        if ($sellercategory->update($request->all())) {
            return redirect('admin/sellercategory')->with('success', trans('sellercategory/message.success.update'));
        } else {
            return Redirect::route('admin/sellercategory')->withInput()->with('error', trans('sellercategory/message.error.update'));
        }
    }

    /**
     * Remove blog.
     *
     * @param BlogCategory $blogCategory
     * @return Response
     */
    public function getModalDelete(SellerCategory $sellerCategory)
    {
        $model = 'sellercategory';
        $confirm_route = $error = null;
        try {
            $confirm_route = route('admin.sellercategory.delete', ['id' => $sellerCategory->id]);
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        } catch (GroupNotFoundException $e) {

            $error = trans('sellercategory/message.error.delete', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
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
         SellerCategory::destroy($id);
        return redirect()->route('admin.sellercategory.index')
                        ->with('success','Record deleted successfully');
    }

}
