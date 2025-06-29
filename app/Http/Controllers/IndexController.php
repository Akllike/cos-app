<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductsServiceInterface;
use App\Models\Products;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __construct(
        protected ProductsServiceInterface $productsService
    ) {}
    public function index(): View
    {
        $data = Products::inRandomOrder()->take(4)->get();
        $cart = session('cart', []);
        //dd($cart);
        return view('main', compact('data', 'cart'));
    }

    public function showAbout(): View
    {
        return view('about');
    }

    public function showDelivery(): View
    {
        return view('delivery');
    }

    public function stock(): View
    {
        $data = Products::where('popular', 1)->get();

        return view('stock', compact('data'));
    }
}
