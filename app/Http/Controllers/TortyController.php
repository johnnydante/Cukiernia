<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZamowTortRequest;
use App\Kategorie;
use App\Tort;
use App\Order;
use App\Callendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Wesele;
use Intervention\Image\Exception\NotReadableException;

class TortyController extends Controller
{

    public function index($id)
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

        $_POST['terminyBezZamowienWesel'] = collect($terminy_wesel)->toArray();

        $_POST['terminyBezZamowien'] =  array_merge($_POST['terminyBezZamowienTortow'], $_POST['terminyBezZamowien'], $_POST['terminyBezZamowienWesel']);

        $dodane_terminy = Callendar::all()->pluck('termin_wykluczony');
        $dodane_terminy = collect($dodane_terminy)->toArray();
        $_POST['wykluczone'] = $dodane_terminy;
        $_POST['tablica_terminow'] = array_merge($tablica_przekroczen, $dodane_terminy, $tablica_przekroczen_tortow, $_POST['terminyBezZamowienWesel']);

        $products = Kategorie::find($id);
        return view ('products.torty.order', compact('products'));
    }

    public function edit($id)
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

        $_POST['terminyBezZamowienWesel'] = collect($terminy_wesel)->toArray();

        $_POST['terminyBezZamowien'] =  array_merge($_POST['terminyBezZamowienTortow'], $_POST['terminyBezZamowien'], $_POST['terminyBezZamowienWesel']);

        $dodane_terminy = Callendar::all()->pluck('termin_wykluczony');
        $dodane_terminy = collect($dodane_terminy)->toArray();
        $_POST['wykluczone'] = $dodane_terminy;
        $_POST['tablica_terminow'] = array_merge($tablica_przekroczen, $dodane_terminy, $tablica_przekroczen_tortow, $_POST['terminyBezZamowienWesel']);

        $tort = Tort::find($id);

        return view ('products.torty.editOrder', compact('tort'));
    }

    public function update(ZamowTortRequest $request, $id)
    {
        if(Input::file('filename')) {
            $image = Input::file('filename');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/products_img/' . $filename);
            Image::make($image->getRealPath())->resize(450, 320)->save($path);

            Tort::find($id)->update($request->except('filename') + [ 'filename' => $filename]);
            return redirect(route('koszyk.index'));
        } else {
            Tort::find($id)->update($request->all());
            return redirect(route('koszyk.index'));
        }
    }

    public function store(ZamowTortRequest $request, $id)
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

                return redirect()->back();
            }
            $_POST['blad_zdjecia'] = '';
        Tort::create($request->except('filename') + ['users_id' => $users_id, 'id_kategorii' => $id, 'status' => 'koszyk', 'filename' => $filename]);
        return redirect(route('koszyk.index'));
        } else {
            Tort::create($request->all() + ['users_id' => $users_id, 'id_kategorii' => $id, 'status' => 'koszyk']);
            return redirect(route('koszyk.index'));
        }
    }

    public function destroy($id)
    {
        if(Tort::find($id)->getUser() == Auth::user() || Auth::user()->isAdmin()) {
            Tort::find($id)->delete();
            return redirect()->back();
        }
    }

    public function destroy_zdjecie($id)
    {
        if(Tort::find($id)->getUser() == Auth::user()) {
            Tort::find($id)->update(array('filename' => null));
            return redirect()->back();
        }
    }

    public function destroyCena($id)
    {
            Tort::find($id)->update(['cena' => null]);
            return redirect(route('order.index'));

    }



}
