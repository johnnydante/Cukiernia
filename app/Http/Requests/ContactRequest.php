<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'wiadomosc' => 'required|min:10',
            'imie' => 'required|min:2',
            'nazwisko' => 'required|min:2',
            'email' => 'required|email',
            'tel' => 'required|min:9|numeric'
        ];
    }

    public function messages()
    {
        return [
            'wiadomosc.required' => 'Wiadomość nie może być pusta!',
            'wiadomosc.min' => 'Wiadomość musi mieć więcej niż 10 znaków!',
            'imie.required' => 'Musisz podać Imię!',
            'imie.min' => 'Imię musi się składać z przynajmniej 2 znaków!',
            'nazwisko.required' => 'Musisz podać nazwisko!',
            'nazwisko.min' => 'Nazwisko musi się składać z przynajmniej 2 znaków!',
            'email.required' => 'E-mail jest wymagany!',
            'email.email' => 'To nie jest poprawny e-mail!',
            'tel.required' => 'Numer telefonu jest wymagany!',
            'tel.min' => 'To ne jest poprawny numer telefonu(proszę podać bez numeru kierunkowego)',
            'tel.numeric' => 'To ne jest poprawny numer telefonu!',
        ];
    }
}
