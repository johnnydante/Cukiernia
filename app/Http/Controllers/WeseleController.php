<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Wesele;
use App\Http\Requests\WeseleZamowRequest;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Http\Requests\WeseleDoRealizacjiRequest;
use Intervention\Image\Exception\NotReadableException;
use App\Order;
use App\Tort;
use Carbon\Carbon;
use App\Callendar;

class WeseleController extends Controller
{
    public function index() {
        return view('wesele.wesela');
    }

    public function show()
    {
        $rodzaj = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('rodzaj');
        $rodzaj = collect($rodzaj)->toArray();
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

        return view('wesele.weseleZamowienie');
    }

    public function zamowStore(WeseleZamowRequest $request)
    {
        $users_id = Auth::id();
        if(Input::file('filename')) {
            $image = Input::file('filename');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/products_img/' . $filename);
            try
            {
            Image::make($image->getRealPath())->resize(450, 320)->save($path);
            }
            catch(NotReadableException $e)
            {

                return redirect()->back()->with('status', 'Problem z odczytem zdjęcia, proszę spróbować dodać inne');
            }
            Wesele::create($request->except('filename') + ['users_id' => $users_id, 'status' => 'koszyk', 'filename' => $filename]);
            return redirect(route('koszyk.index'));
        } else {
            Wesele::create($request->all()+ ['users_id' => $users_id, 'status' => 'koszyk']);
            return redirect(route('koszyk.index'));
        }
    }

    public function destroy_zdjecie($id)
    {
        if(Wesele::find($id)->getUser() == Auth::user()) {
            Wesele::find($id)->update(['filename' => null]);
            return redirect()->back();
        }
    }

    public function destroy($id) {
        if(Wesele::find($id)->getUser() == Auth::user()) {
            Wesele::find($id)->delete();
            return redirect()->back();
        }
    }

    public function edit($id) {
        if(Wesele::find($id)->getUser() == Auth::user()) {
            $rodzaj = Order::all()->whereIn('status', ['oczekuje', 'w realizacji'])->pluck('rodzaj');
            $rodzaj = collect($rodzaj)->toArray();
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


           $wesele = Wesele::find($id);
            return view('wesele.weseleZamowienieEdit', compact('wesele'));
        }
    }

    public function update(WeseleZamowRequest $request, $id) {

        if(Wesele::find($id)->getUser() == Auth::user()) {
            if(Input::file('filename')) {
                $image = Input::file('filename');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('storage/products_img/' . $filename);
                try
                {
                Image::make($image->getRealPath())->resize(450, 320)->save($path);
                }
                catch(NotReadableException $e)
                {

                    return redirect()->back()->with('status', 'Problem z odczytem zdjęcia, proszę spróbować dodać inne');
                }
                Wesele::find($id)->update($request->except('filename') + array('filename' => $filename));
                return redirect(route('koszyk.index'));
            } else {
                Wesele::find($id)->update($request->all());
                return redirect(route('koszyk.index'));
            }
        } else {
            return redirect(route('login'));
        }
    }

    public function nadajCene(WeseleDoRealizacjiRequest $request, $id)
    {
            $cena = 0;
            $cena = $cena + $request->cena;
            Wesele::find($id)->update(['cena' => $cena]);
            return redirect(route('order.index'));
    }

    public function updateDoRealizacji($id)
    {
            Wesele::find($id)->update(array('status' => 'w realizacji'));
            return redirect(route('order.index'));
    }

    public function updateZrealizowane($id)
    {
            Wesele::find($id)->update(array('status' => 'zrealizowane'));
            return redirect(route('order.index'));
    }

    public function destroyWstepne($id)
    {
        if(Wesele::find($id)->getUser() == Auth::user()) {
            Wesele::find($id)->delete();
            return redirect(route('wesele.index'));
        }
    }

    public function destroyCena($id)
    {
            Wesele::find($id)->update(['cena' => null]);
            return redirect(route('order.index'));
    }
}


