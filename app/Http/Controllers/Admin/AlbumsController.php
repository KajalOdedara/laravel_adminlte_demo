<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Image;


class AlbumsController extends Controller
{
    public function getList()
    {
        $albums = Album::with('Photos')->get();
        return View::make('gallery.index')->with('albums', $albums);
    }
    public function getAlbum($id)
    {
        $album = Album::with('Photos')->find($id);
        return View::make('gallery.album')->with('album', $album);
    }
    public function getForm()
    {
        return View::make('gallery.createalbum');
    }
    public function postCreate()
    {
        $rules = array(

            'name' => 'required',
            'cover_image' => 'required|image'

        );

        $validator = Validator::make(FacadesRequest::all(), $rules);
        if ($validator->fails()) {

            return Redirect::route('create_album_form')
                ->withErrors($validator)
                ->withInput();
        }

        $file = FacadesRequest::file('cover_image');
        $random_name = Str::random(8);
        $destinationPath = 'albums/';
        $extension = $file->getClientOriginalExtension();
        $filename = $random_name . '_cover.' . $extension;
        $uploadSuccess = FacadesRequest::file('cover_image')
            ->move($destinationPath, $filename);
        $album = Album::create(array(
            'name' => FacadesRequest::get('name'),
            'description' => FacadesRequest::get('description'),
            'cover_image' => $filename,
        ));

        return Redirect::route('show_album', array('id' => $album->id));
    }

    public function getDelete($id)
    {
        $album = Album::find($id);

        $album->delete();

        return Redirect::route('index');
    }
}
