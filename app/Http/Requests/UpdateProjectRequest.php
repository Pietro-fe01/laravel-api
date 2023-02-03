<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'project_title' => ['string', 'required', Rule::unique('projects')->ignore($this->project), 'max:255'],
            'customer_name' => 'string|required|max:255',
            'description' => 'string|required',
            'cover_image' => 'image|nullable|max:2048',
            'remove_image' => 'nullable',
            'type_id' => 'nullable|exists:types,id',
            'technologies' =>  'nullable|exists:technologies,id',
        ];
    }
}