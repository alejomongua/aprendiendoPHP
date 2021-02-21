<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Main.welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home(Request $request)
    {
        $user = $request->user();
        $images = Image::orderBy('id', 'desc')->paginate(10);
        return view('Main.home', [
            'user' => $user,
            'images' => $images,
        ]);
    }

    
}
