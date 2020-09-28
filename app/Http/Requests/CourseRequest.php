<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|min:10',
            'description' => 'required',
            'price' => 'required|numeric',
            'subject_id' => 'required|exists:subjects,id|integer',
            'level_id' => 'required|exists:levels,id|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom du cours est obligatoire.',
            'description.required' => 'La description du cours est obligatoire.',
            'price.required' => 'Le prix du cours est obligatoire.',
            'subject_id.required' => 'La matière à laquelle le cours est associé est obligatoire.',
            'level_id.required' => 'Le niveau scolaire du cours est obligatoire.',
        ];
    }

}
