<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pictures = Picture::all()->where('user_ID','!=',Auth::user()->id)->where('visible', 1);
        $result_pictures = array();
        foreach ($pictures as $picture) {
            array_push($result_pictures, ['picture' => $picture]);
        }
        return view('home', ['pictures' => $result_pictures, 'userId' => Auth::user()->id]);
    }
}
