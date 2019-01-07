<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        print_r(json_decode(env("SUPPORT_RANKING_OJ")));
    }
}
