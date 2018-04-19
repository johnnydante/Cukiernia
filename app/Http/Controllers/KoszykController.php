<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use Illuminate\Support\Facades\Mail;
use App\Tort;

class KoszykController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::id();

        $zamowienia = Order::orderBy('id', 'DESC')->paginate(100000)->where('users_id', $user_id)->where('status', 'koszyk');
        $torty = Tort::orderBy('id', 'DESC')->paginate(100000)->where('users_id', $user_id)->where('status', 'koszyk');

        $_POST['koszt'] = 0;
        $_POST['koszt_tortow'] = 0;
        foreach($zamowienia as $jedno) {

            if($jedno->wielkosc == 0) {
                $_POST['koszt'] += $jedno->getProduct()->cena * $jedno->ilosc;
            } else {
                $_POST['koszt'] += $jedno->getProduct()->cena_mala * $jedno->ilosc;
            }
        }

        foreach($torty as $jeden) {
                $_POST['koszt_tortow'] += $jeden->cena;
        }

        return view('zamowienia.koszyk', compact('zamowienia'), compact('torty'));
    }

    public function show()
    {
        $user_id = Auth::id();
        $zamowienia = Order::orderBy('termin')->paginate(1000000)->where('users_id', $user_id);
        $torty = Tort::orderBy('termin')->paginate(1000000)->where('users_id', $user_id);
        $_POST['koszt_oczekuje'] = 0;
        $_POST['koszt_tortow_oczekuje'] = 0;
        foreach($zamowienia->where('status', 'oczekuje') as $jedno) {
            if($jedno->wielkosc == 0) {
                $_POST['koszt_oczekuje'] += $jedno->getProduct()->cena * $jedno->ilosc;
            } else {
                $_POST['koszt_oczekuje'] += $jedno->getProduct()->cena_mala * $jedno->ilosc;
            }
        }
        foreach($torty->where('status', 'oczekuje') as $jeden) {
            $_POST['koszt_tortow_oczekuje'] += $jeden->cena;
        }
        return view('zamowienia.zamowienia', compact('zamowienia'), compact('torty'));
    }

    public function showRealizowane()
    {
        $user_id = Auth::id();
        $zamowienia = Order::orderBy('termin')->paginate(1000000)->where('users_id', $user_id);
        $torty = Tort::orderBy('termin')->paginate(1000000)->where('users_id', $user_id);
        $_POST['koszt'] = 0;
        $_POST['koszt_tortow'] = 0;
        foreach($zamowienia->where('status','w realizacji') as $jedno) {
            if($jedno->wielkosc == 0) {
                $_POST['koszt'] += $jedno->getProduct()->cena * $jedno->ilosc;
            } else {
                $_POST['koszt'] += $jedno->getProduct()->cena_mala * $jedno->ilosc;
            }
        }
        foreach($torty->where('status','w realizacji') as $jeden) {
            $_POST['koszt_tortow'] += $jeden->cena;
        }
        return view('zamowienia.wRealizacji', compact('zamowienia'), compact('torty'));
    }

    public function showSkonczone()
    {
        $user_id = Auth::id();
        $zamowienia = Order::orderBy('termin')->paginate(1000000)->where('users_id', $user_id);
        $torty = Tort::orderBy('termin')->paginate(1000000)->where('users_id', $user_id);

        return view('zamowienia.skonczone', compact('zamowienia'), compact('torty'));
    }

    public function update()
    {
        $user_id = Auth::id();


        $order = Order::where('users_id', $user_id)->where('status', 'koszyk');
        $tort = Tort::where('users_id', $user_id)->where('status', 'koszyk');

        if(Order::where('users_id', $user_id)->where('status', 'koszyk')->count()>0) {
            $imie = Order::where('users_id', $user_id)->first()->getUser()->name;
            $nazwisko = Order::where('users_id', $user_id)->first()->getUser()->surname;
            $tel = Order::where('users_id', $user_id)->first()->getUser()->tel;
            $email = Order::where('users_id', $user_id)->first()->getUser()->email;
        } else {
            $imie = Tort::where('users_id', $user_id)->first()->getUser()->name;
            $nazwisko = Tort::where('users_id', $user_id)->first()->getUser()->surname;
            $tel = Tort::where('users_id', $user_id)->first()->getUser()->tel;
            $email = Tort::where('users_id', $user_id)->first()->getUser()->email;
        }

        $data = array(
            'imie' => $imie,
            'nazwisko' => $nazwisko,
            'tel' => $tel,
            'email' => $email,
        );
        $order->update(array('status' => 'oczekuje'));
        $tort->update(array('status' => 'oczekuje'));

        Mail::send('emails.zamowienie', $data, function($message){
            $message->from('cukiernia@cukiernia.pl');
            $message->to('dante.dawid@gmail.com');
            $message->subject('Zamówienie z cukienri');
        });

        return redirect(route('koszyk.index'));

    }
}
