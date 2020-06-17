<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AjaxUploadController extends Controller
{
    public function index_crop()
    {
        return view('admin.images.index_crop');
    }
    public function index_ajax()
    {
        return view('admin.images.index_ajax');
    }
    public function upload(Request $request)
    {
        if ($request->ajax()) {
            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = time() . '.png';
            $upload_path = public_path('crop_image/' . $image_name);
            file_put_contents($upload_path, $data);
            return response()->json(['path' => '/crop_image/' . $image_name]);
        }
    }
    public function action(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validation->passes()) {
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            return response()->json([
                'message'   => 'Image Upload Successfully',
                'uploaded_image' => '<img src="/images/' . $new_name . '" class="img-thumbnail" width="300" />',
                'class_name'  => 'alert-success'
            ]);
        } else {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }
}
