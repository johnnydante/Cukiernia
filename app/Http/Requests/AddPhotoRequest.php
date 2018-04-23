<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPhotoRequest extends FormRequest
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
        return [
            'filename' =>'required|mimes:jpg,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'filename.required' => 'Zdjęcie jest wymagane!',
            'filename.mimes' => 'Zdjęcie musi być w formacie .jpg lub .jpeg!',
        ];
    }
}
