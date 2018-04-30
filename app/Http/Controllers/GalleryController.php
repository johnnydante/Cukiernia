<?php

namespace App\Http\Controllers;

use App\Photos;
use Intervention\Image\Exception\NotReadableException;
use App\Http\Requests\AddPhotoRequest;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{

    public function index()
    {

        $photos = Photos::orderBy('id', 'DESC')->paginate(12);
        $_POST['i'] = -11 + 12*$photos->currentPage();
        return view('galleries.gallery', compact('photos'));
    }

    public function create()
    {
        return view('galleries.create');
    }

    public function store(AddPhotoRequest $request)
    {
            $image = Input::file('filename');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/gallery/new/' . $filename);
            try
            {
                Image::make($image->getRealPath())->resize(427, 320)->save($path);
            }
                catch(NotReadableException $e)
            {

                return redirect()->back()->with('status', 'Problem z odczytem zdjęcia, proszę spróbować dodać inne');
            }
            Photos::create(
                $request->except('filename') +
                ['filename' => $filename]
            );
            return redirect(route('gallery.index'));
    }

    public function show($id, $numer)
    {
        $jedno = Photos::find($id);
        $number = $numer;
        return view('galleries.one_photo', compact('jedno'), compact('number'));
    }

    public function destroy($id)
    {
        Photos::find($id)->delete();
        return redirect()->back();
    }

}
