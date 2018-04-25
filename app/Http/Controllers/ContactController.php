<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function index()
    {
        return view('contact.contact');
    }

    public function postContact(ContactRequest $request)
    {
        $data = array(
            'email' => $request->email,
            'bodyWiadomosc' => $request->wiadomosc,
            'imie' => $request->imie,
            'nazwisko' => $request->nazwisko,
            'tel' => $request->tel
        );

        Mail::send('emails.contact', $data, function($message){
            $message->from('cukiernia@cukiernia.pl');
            $message->to('dante.dawid@gmail.com');
            $message->subject('Wiadomość z formularza cukienri');
        });

        return view('contact.wiadomosc');
    }

}
