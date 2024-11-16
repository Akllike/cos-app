<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;
use App\Services\CartService;

class CartController extends Controller
{
    protected CartService $cartService;
    protected TelegramService $telegramService;

    public function index(): View
    {
        $cart = session('cart', []);
        return view('cart')->with(['cart' => $cart]);
    }

    public function add(Request $request): string
    {
        $productId  = $request->input('product_id');
        $quantity   = $request->input('quantity', 1);

        $this->cartService = new CartService();
        $cart = $this->cartService->addProductToCart($productId, $quantity);

        session(['cart' => $cart]);

        return json_encode($cart, true);
    }

    public function remove(Request $request): View
    {
        $productId = $request->input('product_id');

        $this->cartService = new CartService();
        $cart = $this->cartService->removeProductFromCart($productId);

        return view('cart')->with('cart', $cart);
    }

    public function sendTelegram(Request $request): RedirectResponse
    {
        $send = '';
        $number = $request->input('number');
        $name = $request->input('name');
        $message = $request->input('message');
        $send = "Новый заказ! \nИмя: " . $number . " \nНомер: " . $name . " \nСообщение: " . $message . "\n\n";
        $cart = session('cart', null);

        $i = 1;
        foreach($cart as $item)
        {
            $send .= $i . ". Название: " . $item['name'] . "\n";
            $send .= "Количество: " . $item['quantity'] . " шт.\n";
            $send .= "Сумма: " . $item['price'] * $item['quantity'] . " руб.\n\n";
            $i++;
        }

        $this->telegramService = new TelegramService();
        $this->cartService = new CartService();
        $this->telegramService->sendMessage($send);
        $this->cartService->removeProductFromAllCart();

        return redirect()->back()->with('status', 'Форма успешно отправлена!');
    }
}
