<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $products = Product::all();
        $users = User::count();
        $count = User::where('status', '=', 1)->count();
        // dd($count);
        return view('content', ['users' => $users, 'ActiveUserCounts' => $count, 'products' => $products]);
    }
    // public function showUser()
    // {
    //     $demouser = User::get();
    //     return view('content', compact('demouser'));
    // }
}
