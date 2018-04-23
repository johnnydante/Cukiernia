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
            'cena_mala' => 'required',
            'description' => 'required|min:100|minwords:15',
            'filename' =>'required|mimes:jpg,jpeg'
        ];
    }
    public function messages()
    {
        return [
            'nazwa.required' => 'Nazwa jest wymagana!',
            'cena.required' => 'Pierwsza cena jest wymagana!',
            'cena_mala.required' => 'Druga cena jest wymagana!',
            'nazwa.max' => 'Nazwa może mieć maksymalnie 60 znaków!',
            'description.required' => 'Opis jest wymagany!',
            'description.min' => 'Opis musi się składać przynajmniej z 100 znaków!',
            'description.minwords' => 'Opis musi się składać przynajmniej z 15 słów!',
            'filename.required' => 'Zdjęcie jest wymagane!',
            'filename.mimes' => 'Zdjęcie musi być w formacie .jpg lub .jpeg!',
        ];
    }
}
