<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function index()
    {
        return view('admin.images.index');
    }
    public function upload(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $image = $request->file('select_file');
        $new_name=rand().'-'.$image->getClientOriginalExtension();
        $image->move(public_path('images'),$new_name);
        return back()->with('success','Image Upload successfully')->with('path',$new_name);
    }
}
