<?php

namespace App\Http\Controllers\frontend;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {

        return view('frontend.home');
    }
}
