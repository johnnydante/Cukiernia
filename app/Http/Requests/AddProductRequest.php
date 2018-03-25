<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class AddProductRequest extends FormRequest
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
//        Validator::extend('wordLenght',  function ($attribute, $value, $parameters, $validator) {
//            $words = explode(' ', $value);
//            $nbWords = count($words);
//            return ($nbWords >5);  // replace 5 by the correct $parameters value
//        });

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
            'cena' => 'required',
            'description' => 'required|min:50|minwords:10',
            'filename' =>'required|mimes:jpg,jpeg|dimensions:min_width=900,min_height=600,max_width:1200,max_height=960',
        ];
    }
    public function messages()
    {
        return [
            '*.required' => 'To pole jest wymagane do uzupełnienia :attribute'
        ];
    }
}