<?php

namespace App\Http\Controllers;

use App\Callendar;
use App\Http\Requests\CallendarRequest;
use Illuminate\Support\Facades\Auth;
use App\Order;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Tort;

class KalendarzController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin())
        {
            $rodzaj = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('rodzaj');
            $rodzaj = collect($rodzaj)->toArray();
            $_POST['rodzaj'] = $rodzaj;

            $terminy = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('termin');
            $terminy_tortow = Tort::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('termin');

            $ilosci_brytfanek = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('ilosc');
            $_POST['orders'] = $terminy;
            $_POST['torts'] = $terminy_tortow;
            $_POST['ilosc'] = $ilosci_brytfanek;

            $tablica_przekroczen_tortow = [0];
            for($a=0; $a<$terminy_tortow->count(); $a++)
            {
                $wynik = 0;
                $wartosc = $terminy_tortow[$a];

                for($i=0; $i<$terminy_tortow->count(); $i++)
                {
                    if($wartosc == $terminy_tortow[$i])
                    {
                        $wynik = $wynik + 1;
                    };
                }
                if($wynik>1)
                {
                    $tablica_przekroczen_tortow[$a] = $terminy_tortow[$a];
                }
            }
            $tablica_przekroczen_tortow = array_unique($tablica_przekroczen_tortow);
            $values2 = array_values($tablica_przekroczen_tortow);
            $_POST['terminyBezZamowienTortow'] = $values2;

            $torty_array = collect($terminy_tortow)->toArray();

            $tablica_przekroczen = [0];
            for($a=0; $a<$terminy->count(); $a++)
            {
                $wynik = 0;
                $wartosc = $terminy[$a];

                for($i=0; $i<$terminy->count(); $i++)
                {

                        if($wartosc == $terminy[$i])
                        {
                             $wynik += $ilosci_brytfanek[$i];

                        }

                        for($x=0; $x< $terminy_tortow->count(); $x++) {
                            if ($wartosc == $torty_array[$x]) {

                                $wynik = $wynik + 3;
                            }
                        }
                };

                if($wynik>4)
                {
                    $tablica_przekroczen[$a] = $terminy[$a];
                }
            };
            $tablica_przekroczen = array_unique($tablica_przekroczen);
            $values = array_values($tablica_przekroczen);
            $_POST['terminyBezZamowien'] = $values;


            $_POST['terminyBezZamowien'] =  array_merge($_POST['terminyBezZamowienTortow'], $_POST['terminyBezZamowien']);

            $dodane_terminy = Callendar::all()->pluck('termin_wykluczony');
            $dodane_terminy = collect($dodane_terminy)->toArray();
            $_POST['wykluczone'] = $dodane_terminy;
            $_POST['tablica_terminow'] = array_merge($tablica_przekroczen, $dodane_terminy, $tablica_przekroczen_tortow);

            return view('auth.kalendarz');
        }
        else redirect(route('home'));
    }

    public function store(CallendarRequest $request)
    {

        if(Auth::user()->isAdmin()) {
            Callendar::create($request->all());
            return redirect(route('kalendarz.index'));
        }
        else redirect(route('home'));
    }

    public function destroy()
    {
        $termin_wykluczony = Input::get('termin_odznaczony');
        if(Auth::user()->isAdmin()) {
            Callendar::where('termin_wykluczony', $termin_wykluczony)->delete();
            return redirect(route('kalendarz.index'));
        }
        else redirect(route('home'));
    }
}
