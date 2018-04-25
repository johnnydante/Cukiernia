<?php

namespace App\Http\Controllers;

use App\Kategorie;
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
        $torts = Kategorie::find($id)->first();
        return view('products.torty.edit', compact('torts'));
    }

    public function update(EditKategorieRequest $request, $id)
    {
            Kategorie::find($id)->update(
                $request->except('filename')
            );
            return redirect(route('torty.index'));
    }

    public function create()
    {
        return view('products.torty.create');
    }

    public function store(AddKategorieRequest $request)
    {
            $image = Input::file('filename');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/products_img/' . $filename);
            Image::make($image->getRealPath())->resize(900, 740)->save($path);

            Kategorie::create(
                $request->except('filename') +
                ['filename' => $filename]
            );
            return redirect(route('torty.index'));
    }

    public function destroy($id)
    {
            Kategorie::find($id)->delete();
            return redirect()->back();
    }
}
