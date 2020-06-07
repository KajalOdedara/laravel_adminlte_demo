<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
use Validator;
use Log;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //redirect path
    protected $redirectTo = '/change_password';
    

    public function showChangePasswordForm()
    {
        $user = Auth::getUser();
        return view('auth.change_password', compact('user'));
    }
   
    public function changePassword(Request $request)
    {
        ddd($user);
        $user = Auth::getUser();

        $check = $this->validation_check($request->all())->validate();
       
        Log::Debug($user);
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->password = $request->get('new_password');
            $user->save();
            return redirect($this->redirectTo)->withMessage('Password changed successfully!');
        } else {
            return redirect()->back()->withErrors('Current password is incorrect');
        }
    }
     protected function validation_check(array $data)
    {
        // Log::Debug($data);
        return Validator::make($data, [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
    }
}

