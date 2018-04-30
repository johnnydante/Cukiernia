<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Intervention\Image\Exception\NotReadableException;
use App\Http\Requests\AddInneRequest;
use App\Http\Requests\EditInneRequest;

class InneController extends Controller
{
    public function index()
    {
        $inne = Product::orderBy('id', 'DESC')->where('rodzaj', 'inne')->paginate(12);
        return view('products.inne.inne',  compact('inne'));
    }

    public function show($id)
    {
        $inne = Product::find($id);
        return view ('products.inne.inne_jedno', compact('inne'));
    }

    public function create()
    {
        return view('products.inne.create');
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
            ['filename' => $filename, 'rodzaj' => 'inne', 'cena_mala' => $request->cena]
        );
        return redirect(route('inne.index'));
    }

    public function edit(Product $id)
    {
        $inne = Product::find($id)->first();
        return view('products.inne.edit', compact('inne'));
    }

    public function update(EditInneRequest $request, $id)
    {
        Product::find($id)->update(
            $request->except('filename')
        );
        return redirect(route('inne.index'));
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->back();
    }
}
