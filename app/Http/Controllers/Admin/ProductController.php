<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function getAllProducts(){
        $products=Product::all();
        return View('content',['products'=>$products]);
    }
}
