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
            'filename' =>'required|mimes:jpg,jpeg|dimensions:min_width=36,min_height=24,max_width:7200,max_height=4800'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'To pole jest wymagane do uzupełnienia :attribute'
        ];
    }
}
