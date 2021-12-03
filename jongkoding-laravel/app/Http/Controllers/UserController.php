<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return "22";
    }

    public function __construct(){
        $this->middleware('auth');
    }
}
