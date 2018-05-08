<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\OrderRequest;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Callendar;
use App\Tort;
use App\Http\Requests\TortDoRealizacjiRequest;
use App\Wesele;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function index()
    {
            $orders = Order::orderBy('termin')->paginate(1000);
            $torty = Tort::orderBy('termin')->paginate(1000);
            $wesela = Wesele::orderBy('termin')->paginate(1000);
            return view('auth.zamowienia', compact(['orders', 'torty', 'wesela']));
    }

    public function index_wTrakcie()
    {
            $orders = Order::orderBy('termin')->paginate(1000);
            $torty = Tort::orderBy('termin')->paginate(1000);
            $wesela = Wesele::orderBy('termin')->paginate(1000);
            return view('auth.wTrakcie', compact(['orders', 'torty', 'wesela']));
    }

    public function index_zrealizowane()
    {
            $orders = Order::orderBy('termin', 'DESC')->paginate(1000000000);
            $torty = Tort::orderBy('termin', 'DESC')->paginate(10000000);
            $wesela = Wesele::orderBy('termin', 'DESC')->paginate(1000);
            return view('auth.zrealizowane', compact(['orders', 'torty', 'wesela']));
    }

    public function store(OrderRequest $request, $id)
    {
        $users_id = Auth::id();
        $rodzaj = Product::all()->where('id', $id)->pluck('rodzaj');
        $rodzaj = collect($rodzaj)->toArray();

        if($request->wielkosc == '0')
            $cena = Product::all()->where('id', $id)->pluck('cena');
        else
            $cena = Product::all()->where('id', $id)->pluck('cena_mala');

        if($rodzaj[0] == 'inne') {
            Order::create($request->all() + ['users_id' => $users_id, 'id_produktu' => $id,
                    'status' => 'koszyk', 'wielkosc' => '0', 'rodzaj' => $rodzaj[0], 'suma' => $request->ilosc*$cena[0]]);
        } else {
            Order::create($request->all() + ['users_id' => $users_id, 'id_produktu' => $id,
                    'status' => 'koszyk', 'rodzaj' => $rodzaj[0], 'suma' => $request->ilosc*$cena[0]]);
        }
        return redirect(route('koszyk.index'));
    }

    public function show($id)
    {
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

        $products = Product::find($id);
        return view ('zamowienia.order', compact('products'));
    }

    public function edit($id)
    {
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

        $order = Order::where('id', $id)->first();
        return view('zamowienia.editOrder', compact('order'));
    }

    public function update(OrderRequest $request, $id)
    {
        Order::find($id)->update($request->all());
        return redirect(route('koszyk.index'));
    }

    public function updateDoRealizacji($id)
    {
            Order::find($id)->update(array('status' => 'w realizacji'));
            return redirect(route('order.index'));
    }

    public function updateTortDoRealizacji($id)
    {
            Tort::find($id)->update(array('status' => 'w realizacji'));
            return redirect(route('order.index'));
    }

    public function tortNadajCene(TortDoRealizacjiRequest $request, $id)
    {
            $cena = 0;
            $cena = $cena + $request->cena;
            Tort::find($id)->update(['cena' => $cena]);
            return redirect(route('order.index'));
    }

    public function updateZrealizowane($id)
    {
            Order::find($id)->update(['status' => 'zrealizowane']);
            return redirect(route('order.index_wTrakcie'));
    }

    public function updateTortZrealizowane($id)
    {
            Tort::find($id)->update(['status' => 'zrealizowane']);
            return redirect(route('order.index_wTrakcie'));
    }

    public function destroy($id)
    {
        if(Order::find($id)->getUser() == Auth::user() || Auth::user()->isAdmin()) {
            Order::find($id)->delete();
            return redirect()->back();
        }
    }
}
