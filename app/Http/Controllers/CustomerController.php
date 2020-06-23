<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
       public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->save();

        dd($customer);
        
        return response()->json([
            'success' => true,
            'message' => 'Customer successfully added'
        ]);
        
    }
}
