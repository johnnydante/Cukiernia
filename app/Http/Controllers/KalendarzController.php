<?php

namespace App\Http\Controllers;

use App\Callendar;
use App\Http\Requests\CallendarRequest;
use Illuminate\Support\Facades\Auth;
use App\Order;
use Illuminate\Support\Facades\Input;


class KalendarzController extends Controller
{
    public function index()
    {
        if(Auth::user()->isAdmin())
        {
            $terminy = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('termin');
            $ilosci_brytfanek = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('ilosc');
            $tablica_przekroczen = [];
            for($a=0; $a<$terminy->count(); $a++)
            {
                $wynik = 0;
                $wartosc = $terminy[$a];

                for($i=0; $i<$terminy->count(); $i++)
                {
                    if($wartosc == $terminy[$i])
                    {
                        $wynik +=$ilosci_brytfanek[$i];
                    };
                }
                if($wynik>2)
                {
                    $tablica_przekroczen[$a] = $terminy[$a];
                }
            }
            $tablica_przekroczen = array_unique ($tablica_przekroczen);
            $_POST['terminyBezZamowien'] = $tablica_przekroczen;

            $dodane_terminy = Callendar::all()->pluck('termin_wykluczony');
            $dodane_terminy = collect($dodane_terminy)->toArray();
            $_POST['wykluczone'] = $dodane_terminy;
            $_POST['tablica_terminow'] = array_merge($tablica_przekroczen, $dodane_terminy);
            $kalendarz = Callendar::all();
            return view('auth.kalendarz', compact('kalendarz'));
        }
    }

    public function store(CallendarRequest $request)
    {

        if(Auth::user()->isAdmin()) {
            Callendar::create($request->all());
            return redirect(route('kalendarz.index'));
        }
    }

    public function destroy()
    {
        $termin_wykluczony = Input::get('termin_odznaczony');
        if(Auth::user()->isAdmin()) {
            Callendar::where('termin_wykluczony', $termin_wykluczony)->delete();
            return redirect(route('kalendarz.index'));
        }
    }
}
