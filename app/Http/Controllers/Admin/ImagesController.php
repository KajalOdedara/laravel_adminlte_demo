<?php

namespace App\Http\Controllers\admin;

use App\Album;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request as request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Facades\View;

class ImagesController extends Controller
{
    public function getForm($id)
    {
        $album = Album::find($id);
        return View::make('gallery.addimage')
            ->with('album', $album);
    }

    public function postAdd()
    {
        $rules = array(

            'album_id' => 'required|numeric|exists:albums,id',
            'image' => 'required|image'

        );

        $validator = FacadesValidator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::route('add_image', array('id' => Request::get('album_id')))
                ->withErrors($validator)
                ->withInput();
        }

        $file = Request::file('image');
        $random_name = Str::random(8);
        $destinationPath = 'albums/';
        $extension = $file->getClientOriginalExtension();
        $filename = $random_name . '_album_image.' . $extension;
        $uploadSuccess = Request::file('image')->move($destinationPath, $filename);
        Image::create(array(
            'description' => Request::get('description'),
            'image' => $filename,
            'album_id' => Request::get('album_id')
        ));

        return Redirect::route('show_album', array('id' => Request::get('album_id')));
    }
    public function getDelete($id)
    {
        $image = Image::find($id);
        $image->delete();
        return Redirect::route('show_album', array('id' => $image->album_id));
    }
    
}
