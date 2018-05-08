<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Wesele;
use App\Http\Requests\WeseleZamowRequest;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Http\Requests\WeseleDoRealizacjiRequest;
use Intervention\Image\Exception\NotReadableException;

class WeseleController extends Controller
{
    public function index() {
        return view('wesele.wesela');
    }

    public function show()
    {
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


