<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Wesele;
use App\Http\Requests\WeseleStartRequest;
use App\Http\Requests\WeseleZamowRequest;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Http\Requests\WeseleDoRealizacjiRequest;

class WeseleController extends Controller
{
    public function index() {
        return view('wesele.wesela');
    }

    public function store(WeseleStartRequest $request)
    {
            $users_id = Auth::id();
            Wesele::create($request->all() + ['users_id' => $users_id, 'termin' => '0000-00-00', 'na_ile_osob_tort' => 0, 'rodzaj_tortu' => 'brak', 'smak' =>'brak', 'wielkosc_paczki' => 'brak', 'rodzaj_paczki' => 'brak', 'ile_paczek' => 0, 'status' => 'brak', 'cena' => null]);
            return redirect(route('wesele.zamowienie'));
    }

    public function zamowienie()
    {
        $users_id = Auth::id();
        $wesele = Wesele::where('users_id', $users_id)->orderBy('id', 'DESC')->first();
        return view('wesele.weseleZamowienie', compact('wesele'));
    }

    public function zamowStore(WeseleZamowRequest $request, $id)
    {
            if(Input::file('filename')) {
                $image = Input::file('filename');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('storage/products_img/' . $filename);
                Image::make($image->getRealPath())->resize(450, 320)->save($path);

                Wesele::find($id)->update($request->except('filename') + ['status' => 'koszyk', 'filename' => $filename, 'cena' => null]);
                return redirect(route('koszyk.index'));
            } else {
                Wesele::find($id)->update($request->all()+ ['status' => 'koszyk']);
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
                Image::make($image->getRealPath())->resize(450, 320)->save($path);

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


