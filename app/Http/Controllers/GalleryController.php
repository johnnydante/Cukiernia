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
            Image::make($image->getRealPath())->resize(427, 320)->save($path);

            Photos::create(
                $request->except('filename') +
                ['filename' => $filename]
            );
            return redirect(route('gallery.index'));
    }

    public function show($id, $numer)
    {
        $photo = Photos::find($id);
        return view('galleries.one_photo', compact('photo'), compact('numer'));
    }

    public function destroy($id)
    {
            Photos::find($id)->delete();
            return redirect()->back();
    }

}
