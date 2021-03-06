<?php

namespace App\Http\Controllers;

use App\Callendar;
use App\Http\Requests\CallendarRequest;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Wesele;
use App\Tort;

class KalendarzController extends Controller
{

    public function index()
    {
        $rodzaj = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('rodzaj');
        $rodzaj = collect($rodzaj)->toArray();
        $_POST['rodzaj'] = $rodzaj;

        $terminy = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('termin');
        $terminy_tortow = Tort::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('termin');
        $terminy_wesel = Wesele::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('termin');
        $ilosci_brytfanek = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('ilosc');

        $_POST['orders'] = $terminy;
        $_POST['torts'] = $terminy_tortow;
        $_POST['weseles'] = $terminy_wesel;
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

        $_POST['terminy_start'] = [];
        $_POST['terminy_end'] = [];
        for($a=0; $a<$terminy->count(); $a++)
        {
            $wynik = 0;
            $wartosc = $terminy[$a];
            for($i=0; $i<$terminy->count(); $i++)
            {
                if($wartosc == $terminy[$i])
                {
                    if($rodzaj[$i]=='ciasteczko') {
                        $ilosci_ciasteczek[$i] = $ilosci_brytfanek[$i]/50;
                        $wynik += $ilosci_ciasteczek[$i];
                    } else {
                        $wynik += $ilosci_brytfanek[$i];
                    }
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
            if($wynik>9)
            {
                $termin_start = Carbon::createFromFormat('Y-m-d', $tablica_przekroczen[$a]);
                array_push($_POST['terminy_end'], $tablica_przekroczen[$a]);
                array_push($_POST['terminy_start'], $termin_start->subDays(substr(($wynik-5)/5, 0, 1))->format('Y-m-d'));
            }
        };
        $_POST['terminy_start'] = array_unique($_POST['terminy_start']);
        $_POST['terminy_end'] = array_unique($_POST['terminy_end']);


        $tablica_przekroczen = array_unique($tablica_przekroczen);
        $values = array_values($tablica_przekroczen);
        $_POST['terminyBezZamowien'] = $values;

        $_POST['weseles_start'] = [];
        foreach($terminy_wesel as $key => $termin) {
            $termin_start = Carbon::createFromFormat('Y-m-d', $termin);
            array_push($_POST['weseles_start'], $termin_start->subDays(5)->format('Y-m-d'));
        }


        $_POST['terminyBezZamowienWesel'] = collect($terminy_wesel)->toArray();
        $_POST['terminyBezZamowien'] =  array_merge($_POST['terminyBezZamowienTortow'], $_POST['terminyBezZamowien']);


        $dodane_terminy = Callendar::all()->pluck('termin_wykluczony');
        $dodane_terminy = collect($dodane_terminy)->toArray();
        $_POST['wykluczone'] = $dodane_terminy;
        $_POST['tablica_terminow'] = array_merge($tablica_przekroczen, $dodane_terminy, $tablica_przekroczen_tortow);

        return view('auth.kalendarz');
    }

    public function store(CallendarRequest $request)
    {
        Callendar::create($request->all());
        return redirect(route('kalendarz.index'));
    }

    public function destroy()
    {
        $termin_wykluczony = Input::get('termin_odznaczony');
        Callendar::where('termin_wykluczony', $termin_wykluczony)->delete();
        return redirect(route('kalendarz.index'));
    }
}
