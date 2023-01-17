<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'cover_img' => 'nullable|image|max:250',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',
            'title' => 'required|min:3',
            'description' => 'nullable',
        ];
    }
}
