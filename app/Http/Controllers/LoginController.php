<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;

class LoginController extends Controller
{
    public function show(Request $request){
        return view('login');
    }
}
