<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\CartService;

class CartController extends Controller
{
    protected CartService $cartService;
    protected TelegramService $telegramService;

    public function index(Request $request): View
    {
        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Request $request): array
    {
        $productId  = $request->input('product_id');
        $quantity   = $request->input('quantity', 1);

        $this->cartService = new CartService();
        $cart = $this->cartService->addProductToCart($productId, $quantity);

        session(['cart' => $cart]);

        return ['cart' => $cart];
    }

    public function remove(Request $request): View
    {
        $productId = $request->input('product_id');

        $this->cartService = new CartService();
        $cart = $this->cartService->removeProductFromCart($productId);

        return view('cart')->with('cart', $cart);
    }

    public function sendTelegram(Request $request): View
    {
        $number = $request->input('number');
        $message = $request->input('message');
        $send = 'Новый заказ! <br>Номер: ' . $number . '<br>Сообщение: ' . $message;

        $this->telegramService = new TelegramService();
        $this->telegramService->sendMessage($request->input($send));
        $cart = session('cart', null);
        return view('cart', compact('cart'));
    }
}
