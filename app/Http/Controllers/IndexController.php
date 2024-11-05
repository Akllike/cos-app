<?php

namespace App\Http\Controllers;

use App\Models\Scrab;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        $data = Scrab::all();
        return view('main', compact('data'));
    }
}
