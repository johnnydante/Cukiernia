<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class CiasteczkaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->where('rodzaj', 'ciasteczko')->paginate(12);

        return view('products.ciasteczka.ciasteczka',  compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isAdmin()) {
            return view('products.ciasteczka.create');
        }
        else redirect(route('home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
        if(Auth::user()->isAdmin()) {

            $image = Input::file('filename');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/products_img/' . $filename);
            Image::make($image->getRealPath())->resize(900, 640)->save($path);

//            $request->file('filename')->store('public/products_img');
            Product::create(
                $request->except('filename') +
                ['filename' => $filename, 'rodzaj' => 'ciasteczko']
            );

            return redirect(route('ciasteczka.index'));
        }
        else redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);

        return view ('products.ciasteczka.ciasteczko', compact('products'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $id)
    {
        if(Auth::user()->isAdmin()) {
            $products = Product::find($id)->first();
            return view('products.ciasteczka.edit', compact('products'));
        }
        else redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, $id)
    {
        if(Auth::user()->isAdmin()) {

            Product::find($id)->update(
                $request->except('filename')
            );
            return redirect(route('ciasteczka.index'));
        }
        else redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->isAdmin()){
            Product::find($id)->delete();
            return redirect()->back();
        }
        else redirect(route('home'));
    }
}
