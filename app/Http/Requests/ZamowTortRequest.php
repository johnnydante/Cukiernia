<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZamowTortRequest extends FormRequest
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
            'na_ile_osob' => 'required|min:1',
            'termin' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'na_ile_osob.required' => 'Ilość osób jest wymagana!',
            'na_ile_osob.min' => 'Minimalna ilość osób to 1!',
            'termin.required' => 'Termin jest wymagany!',

        ];
    }
}
