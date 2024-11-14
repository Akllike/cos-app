<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        $data = Products::inRandomOrder()->take(4)->get();
        $cart = session('cart', []);
        //dd($cart);
        return view('main', compact('data', 'cart'));
    }
}
