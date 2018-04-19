<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategorie;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditKategorieRequest;
use App\Http\Requests\AddKategorieRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

class KategorieTortowController extends Controller
{
    public function index()
    {
        $torts = Kategorie::all();

        return view('products.torty.torty',  compact('torts'));
    }

    public function show($id)
    {
        $torts = Kategorie::find($id);

        return view ('products.torty.tort', compact('torts'));

    }

    public function edit(Kategorie $id)
    {
        if(Auth::user()->isAdmin()) {
        $torts = Kategorie::find($id)->first();
        return view('products.torty.edit', compact('torts'));
        }
        else redirect(route('home'));
    }

    public function update(EditKategorieRequest $request, $id)
    {
        if(Auth::user()->isAdmin()) {

            Kategorie::find($id)->update(
                $request->except('filename')
            );
            return redirect(route('torty.index'));
        }
        else redirect(route('home'));
    }

    public function create()
    {
        if(Auth::user()->isAdmin()) {
        return view('products.torty.create');
        }
        else redirect(route('home'));
    }

    public function store(AddKategorieRequest $request)
    {
        if(Auth::user()->isAdmin()) {

            $image = Input::file('filename');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/products_img/' . $filename);
            Image::make($image->getRealPath())->resize(900, 740)->save($path);

//            $request->file('filename')->store('public/products_img');
            Kategorie::create(
                $request->except('filename') +
                ['filename' => $filename]
            );

            return redirect(route('torty.index'));
        }
        else redirect(route('home'));
    }

    public function destroy($id)
    {
        if(Auth::user()->isAdmin()){
            Kategorie::find($id)->delete();
            return redirect()->back();
        }
        else redirect(route('home'));
    }
}
