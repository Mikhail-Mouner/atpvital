<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'name' => 'required|string|unique:App\Models\Tag,name|min:3|max:191',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|string|unique:App\Models\Tag,name,' . $this->route()->tag->id . '|min:3|max:191',
                ];
            default:
                break;
        }
    }
}
