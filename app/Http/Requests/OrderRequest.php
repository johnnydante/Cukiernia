<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'ilosc' => 'required|min:1',
            'termin' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'ilosc.required' => 'Ilość jest wymagana!',
            'ilosc.min' => 'Minimalna ilość to 1!',
            'termin.required' => 'Termin jest wymagany!',

        ];
    }
}
