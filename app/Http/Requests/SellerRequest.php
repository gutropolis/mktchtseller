<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

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
                    'title' => 'required|min:3',
                    'description' => 'required|min:3',
                    'location' => 'required|email|unique:users,email',
                    'pic_file' => 'mimes:jpg,jpeg,bmp,png,gif|max:10000'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'title' => 'required|min:3',
                    'description' => 'required|min:3',
                    'location' => 'required|min:3',
                    'pic_file' => 'mimes:jpg,jpeg,bmp,png,gif|max:10000'
                ];
            }
            default:
                break;
        }

        return [

        ];
    }


}

