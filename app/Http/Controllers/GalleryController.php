<?php

namespace App\Http\Controllers;

use App\Photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddPhotoRequest;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $photos = Photos::orderBy('id', 'DESC')->paginate(12);


        $_POST['i'] = -11 + 12*$photos->currentPage();

        return view('galleries.gallery', compact('photos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPhotoRequest $request)
    {
        if(Auth::user()->isAdmin()) {

            $image = Input::file('filename');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/gallery/new/' . $filename);
            Image::make($image->getRealPath())->resize(427, 320)->save($path);

//            $request->file('filename')->store('public/gallery');
            Photos::create(
                $request->except('filename') +
                ['filename' => $filename]
            );
            return redirect(route('gallery.index'));
        }
        else redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $numer)
    {

        $photo = Photos::find($id);

        return view('galleries.one_photo', compact('photo'), compact('numer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            Photos::find($id)->delete();
            return redirect()->back();
        }

    }
}
