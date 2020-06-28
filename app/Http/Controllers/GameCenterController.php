<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameCenterController extends Controller
{
    public function index()
    {
        dd('Game Center');
    }

    public function movement()
    {
        return view('gamecenter/movement');
    }
}
