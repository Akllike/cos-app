<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function index(Request $request): View
    {
        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Request $request): View
    {
        $productId  = $request->input('product_id');
        $quantity   = $request->input('quantity', 1);

        $this->cartService = new CartService();
        $cart = $this->cartService->addProductToCart($productId, $quantity);

        session(['cart' => $cart]);

        return view('cart')->with('cart', $cart);
    }

    // Удаление товара из корзины
    public function remove(Request $request): View
    {
        $productId = $request->input('product_id');

        $this->cartService = new CartService();
        $cart = $this->cartService->removeProductFromCart($productId);

        return view('cart')->with('cart', $cart);
    }
}
