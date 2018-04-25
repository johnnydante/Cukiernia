<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Product;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

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

    public function store(AddProductRequest $request)
    {
            $image = Input::file('filename');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/products_img/' . $filename);
            Image::make($image->getRealPath())->resize(900, 640)->save($path);

            Product::create(
                $request->except('filename') +
                ['filename' => $filename, 'rodzaj' => 'ciasteczko']
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

    public function update(EditProductRequest $request, $id)
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
