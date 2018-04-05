<?php

namespace App\Http\Controllers\Admin;

use\App\Http\Controllers\JoshController;
use App\ProductCategory;
use App\Http\Requests;
use Sentinel;
use App\Http\Requests\ProductCategoryRequest;


class ProductCategoryController extends JoshController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $Category = ProductCategory::all();
		
		
        return view('admin.productcategory.index',compact('Category'));
    
    }

   

   
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
		$productcategory=ProductCategory::find($id);
        return view('admin.productcategory.edit', compact('productcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogCategory $blogCategory
     * @return Response
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productcategory)
    {
        if ($productcategory->update($request->all())) {
            return redirect('admin/productcategory')->with('success', trans('productcategory/message.success.update'));
        } else {
            return Redirect::route('admin/productcategory')->withInput()->with('error', trans('productcategory/message.error.update'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param SellerCategory $blogCategory
     * @return Response
     */
    public function destroy($id)
    {
  //charity::destroy($id);
         ProductCategory::destroy($id);
        return redirect()->route('admin.sellercategory.index')
                        ->with('success','Record deleted successfully');
    }

}
