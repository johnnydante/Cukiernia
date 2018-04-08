<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use Illuminate\Support\Facades\Mail;

class KoszykController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::id();
        $zamowienia = Order::orderBy('id', 'DESC')->paginate(7)->where('users_id', $user_id)->where('status', 'koszyk');
        return view('zamowienia.koszyk', compact('zamowienia'));
    }

    public function show()
    {
        $user_id = Auth::id();
        $zamowienia = Order::orderBy('id', 'DESC')->paginate(7)->where('users_id', $user_id)->whereIn('status', ['oczekuje', 'w realizacji']);
        return view('zamowienia.zamowienia', compact('zamowienia'));
    }

    public function update()
    {
        $user_id = Auth::id();
        Order::where('users_id', $user_id)->where('status', 'koszyk')->update(array('status' => 'oczekuje'));

        $imie = Order::where('users_id', $user_id)->where('status', 'oczekuje')->first()->getUser()->name;
        $nazwisko = Order::where('users_id', $user_id)->where('status', 'oczekuje')->first()->getUser()->surname;
        $tel = Order::where('users_id', $user_id)->where('status', 'oczekuje')->first()->getUser()->tel;
        $email = Order::where('users_id', $user_id)->where('status', 'oczekuje')->first()->getUser()->email;

        $data = array(
            'imie' => $imie,
            'nazwisko' => $nazwisko,
            'tel' => $tel,
            'email' => $email,

        );

        Mail::send('emails.zamowienie', $data, function($message){
            $message->from('cukiernia@cukiernia.pl');
            $message->to('dante.dawid@gmail.com');
            $message->subject('Zamówienie z cukienri');
        });

        return redirect(route('koszyk.index'));

    }
}
