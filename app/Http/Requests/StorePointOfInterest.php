<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePointOfInterest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'nullable|string',
            'coordinates' => 'nullable|string',
            'phone' => 'nullable|string|min:6|max:20',
            'website' => 'nullable|url',
            'description' => 'required|string',
            'visible' => 'required|boolean',
            'point_id' => 'required|exists:point_of_interest_categories,id',
            'images' => 'required|array',
        ];
    }
}
