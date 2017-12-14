<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharityCategoryRequest extends FormRequest
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
	 public function rules()
    {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'title' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                $id = $this->route('charitycategory')->id;
                return [
                    'title' => 'required',
                ];
            }
            default:
                break;
        }


    }
}

?>