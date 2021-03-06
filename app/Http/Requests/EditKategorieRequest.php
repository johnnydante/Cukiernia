<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class EditKategorieRequest extends FormRequest
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
        Validator::extend('minwords', function($attribute, $value, $parameters, $validator) {
            $words = preg_split( '@\s+@i', trim( $value ) );
            if(isset($parameters[1])) {
                if( count( $words ) >= $parameters[ 0 ] AND count( $words ) <= $parameters[ 1 ]) {
                    return true;
                }
            } else {
                if( count( $words ) >= $parameters[ 0 ]) {
                    return true;
                }
            }
            return false;
        });

        return [
            'nazwa' => 'required|max:60',
            'opis' => 'required|min:100|minwords:15',
//            'filename' =>'required|mimes:jpg,jpeg|dimensions:min_width=900,min_height=600,max_width:1200,max_height=960',
        ];
    }
    public function messages()
    {
        return [
            'nazwa.required' => 'Nazwa jest wymagana!',
            'nazwa.max' => 'Nazwa może mieć maksymalnie 60 znaków!',
            'opis.required' => 'Opis jest wymagany!',
            'opis.min' => 'Opis musi się składać przynajmniej z 100 znaków!',
            'description.minwords' => 'Opis musi się składać przynajmniej z 15 słów!',
        ];
    }
}
