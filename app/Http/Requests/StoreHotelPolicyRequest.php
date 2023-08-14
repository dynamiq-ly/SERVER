<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelPolicyRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'subTitle' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:10240', // Assuming max file size is 10MB
            'type' => 'required|in:APPLICATION,HOTEL',
        ];
    }
}
