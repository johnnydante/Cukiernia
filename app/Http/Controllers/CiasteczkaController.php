<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddInneRequest;
use App\Http\Requests\EditInneRequest;
use App\Product;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Intervention\Image\Exception\NotReadableException;

class CiasteczkaController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->where('rodzaj', 'ciasteczko')->paginate(12);
        return view('products.ciasteczka.ciasteczka',  compact('products'));
    }

    public function create()
    {
            return view('products.ciasteczka.create');
    }

    public function store(AddInneRequest $request)
    {
            $image = Input::file('filename');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/products_img/' . $filename);
            try
            {
            Image::make($image->getRealPath())->resize(900, 640)->save($path);
            }
            catch(NotReadableException $e)
            {
            return redirect()->back()->with('status', 'Problem z odczytem zdjęcia, proszę spróbować dodać inne');
            }

            Product::create(
                $request->except('filename') +
                ['filename' => $filename, 'rodzaj' => 'ciasteczko', 'cena_mala' => $request->cena]
            );
            return redirect(route('ciasteczka.index'));
    }

    public function show($id)
    {
        $products = Product::find($id);
        return view ('products.ciasteczka.ciasteczko', compact('products'));
    }

    public function edit(Product $id)
    {
            $products = Product::find($id)->first();
            return view('products.ciasteczka.edit', compact('products'));
    }

    public function update(EditInneRequest $request, $id)
    {
            Product::find($id)->update(
                $request->except('filename')
            );
            return redirect(route('ciasteczka.index'));
    }

    public function destroy($id)
    {
            Product::find($id)->delete();
            return redirect()->back();
    }
}
