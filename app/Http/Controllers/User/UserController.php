<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UserController extends Controller
{
    public function search()
    {
        $q = FacadesRequest::get('q');
        // dd($q);
        // if ($q != "") {
            $users = User::where('name', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->get();
            // if (count($user) > 0)
                return view('user.index')->withUsers($users)->withQuery($q);
        // }
        // return view('user.index')->withMessage('No Details found. Try to search again !');
    }
    
    public function index(Request $request)
    {        
        // print_r($request->all());exit();
        // $users = DB::table('users')->count();
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }
}
