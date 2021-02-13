<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function welcome() {
        return view('Main.welcome');
    }

    public function echo($mensaje) {
        echo $mensaje;
    }
}
