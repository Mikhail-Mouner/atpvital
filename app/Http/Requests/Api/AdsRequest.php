<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
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
            case 'GET': {
                    return [
                        'keyword' => 'nullable|string',
                    ];
                }
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'type' => 'nullable|in:free,paid',
                        'start_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:today',
                        'title' => 'required|string|unique:App\Models\Ads,title|min:3|max:191',
                        'description' => 'required|string',
                        'category_id' => 'required|exists:App\Models\Category,id',
                        'tag_id' => 'nullable|array',
                        'tag_id.*' => 'nullable|distinct|exists:App\Models\Tag,id',
                        'advertiser' => 'required|exists:App\Models\User,id',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'type' => 'nullable|in:free,paid',
                        'start_date' => 'required|date_format:Y-m-d H:i:s|after_or_equal:today',
                        'title' => 'required|string|unique:App\Models\Ads,title,' . $this->route()->ad->id . '|min:3|max:191',
                        'description' => 'required|string',
                        'category_id' => 'required|exists:App\Models\Category,id',
                        'tag_id' => 'nullable|array',
                        'tag_id.*' => 'nullable|distinct|exists:App\Models\Tag,id',
                        'advertiser' => 'required|exists:App\Models\User,id',
                    ];
                }
            default:
                break;
        }
    }
}
