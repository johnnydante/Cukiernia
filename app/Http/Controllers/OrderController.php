<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\OrderRequest;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Callendar;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin())
        {

            $orders = Order::orderBy('id', 'DESC')->paginate(7);
            return view('auth.zamowienia', compact('orders'));
        }
    }

    public function index_wTrakcie()
    {
        if(Auth::user()->isAdmin())
        {

            $orders = Order::orderBy('id', 'DESC')->paginate(7);
            return view('auth.wTrakcie', compact('orders'));
        }
    }

    public function index_zrealizowane()
    {
        if(Auth::user()->isAdmin())
        {

            $orders = Order::orderBy('id', 'DESC')->paginate(7);
            return view('auth.zrealizowane', compact('orders'));
        }
    }

    public function create()
    {
        //
    }

    public function store(OrderRequest $request, $id)
    {
        $users_id = Auth::id();
        Order::create($request->all() + ['users_id' => $users_id] + ['id_produktu' => $id] + ['status' => 'koszyk']);
        return redirect(route('koszyk.index'));
    }

    public function show($id)
    {
        $terminy = Order::all()->pluck('termin');
        $ilosci_brytfanek = Order::all()->pluck('ilosc');
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
            if($wynik>4)
            {
                $tablica_przekroczen[$a] = $terminy[$a];
            }
        }
        $tablica_przekroczen = array_unique ($tablica_przekroczen);
        $_POST['terminyBezZamowien'] = $tablica_przekroczen;

        $_POST['tablica_terminow'] = $tablica_przekroczen + [];

        $dodane_terminy = Callendar::all()->pluck('termin_wykluczony');
        $dodane_terminy = collect($dodane_terminy)->toArray();

        $_POST['tablica_terminow'] = array_merge($tablica_przekroczen, $dodane_terminy);

        $products = Product::find($id);
        return view ('zamowienia.order', compact('products'));
    }

    public function edit($id)
    {
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
        if(Auth::user()->isAdmin()) {
            Order::find($id)->update(array('status' => 'w realizacji'));
            return redirect(route('order.index'));
        }
    }

    public function updateZrealizowane($id)
    {
        if(Auth::user()->isAdmin()) {
            Order::find($id)->update(array('status' => 'zrealizowane'));
            return redirect(route('order.index_wTrakcie'));
        }
    }

    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect()->back();
    }
}
