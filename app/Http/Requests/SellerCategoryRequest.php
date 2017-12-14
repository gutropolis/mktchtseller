<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;


class SellerCategoryRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'title' => 'required|unique:blog_categories|min:3',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                $seller_id = $this->route('sellercategory')->id;
                return [
                    'title' => 'required|min:3|unique:blog_categories,title,' . $seller_id
                ];
            }
            default:
                break;
        }


    }



}
