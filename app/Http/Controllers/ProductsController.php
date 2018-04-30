<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Product;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Intervention\Image\Exception\NotReadableException;

class ProductsController extends Controller
{


    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->where('rodzaj', 'ciasto')->paginate(12);
        return view('products.products',  compact('products'));
    }

    public function create()
    {
            return view('products.create');
    }

    public function store(AddProductRequest $request)
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
                ['filename' => $filename, 'rodzaj' => 'ciasto']
            );
            return redirect(route('products.index'));
    }

    public function show($id)
    {
        $products = Product::find($id);
        return view ('products.product', compact('products'));
    }

    public function edit(Product $id)
    {
        $products = Product::find($id)->first();
        return view('products.edit', compact('products'));
    }

    public function update(EditProductRequest $request, $id)
    {
            Product::find($id)->update(
                $request->except('filename')
            );
            return redirect(route('products.index'));
    }

    public function destroy($id)
    {
            Product::find($id)->delete();
            return redirect()->back();
    }
}
