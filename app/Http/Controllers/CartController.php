<?php

namespace App\Http\Controllers;

use App\Interfaces\CartServiceInterface;
use App\Models\Orders;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    protected TelegramService $telegramService;

    public function __construct(
        protected CartServiceInterface $cartService
    ) {}
    public function index(): View
    {
        $cart = session('cart', []);
        return view('cart')->with(['cart' => $cart]);
    }

    public function get(Request $request): string
    {
        $cart = session('cart', []);
        return json_encode($cart, true);
    }

    public function add(Request $request): string
    {
        $productId  = $request->input('product_id');
        $quantity   = $request->input('quantity', 1);

        $cart = $this->cartService->addProductToCart($productId, $quantity);

        ksort($cart);
        session(['cart' => $cart]);

        return json_encode($cart, true);
    }

    public function remove(Request $request): string
    {
        $productId  = $request->input('product_id');
        $quantity   = $request->input('quantity');

        $cart = $this->cartService->removeProductFromCart($productId, $quantity);

        return json_encode($cart, true);
    }

    public function sendTelegram(Request $request): RedirectResponse
    {
        $send = '';
        $number = $request->input('number');
        $name = $request->input('name');
        $message = $request->input('message');

        if(empty($message))
        {
            $status = 'Ваш заказ успешно отправлен!';
            $send = "Новый заказ! \nИмя: " . $number . " \nНомер: " . $name . "\n\n";
        }
        else
        {
            $status = 'Ваш заказ успешно отправлен!';
            $send = "Новый заказ! \nИмя: " . $number . " \nНомер: " . $name . " \nСообщение: " . $message . "\n\n";
        }

        $cart = session('cart', null);
        $i = 1;

        foreach($cart as $item)
        {
            $send .= $i . ". Название: " . $item['name'] . "\n";
            $send .= "Количество: " . $item['quantity'] . " шт.\n";
            $send .= "Сумма: " . $item['price'] * $item['quantity'] . " руб.\n\n";
            $i++;
        }

        $cartsend = '';

        foreach ($cart as $key => $value) {
            $cartsend .= $value['name'] . ',' . $value['quantity'] . ';';
        }

        $data = new Orders();
        if ($data)
        {
            $data->name = $number;
            $data->number = $name;
            $data->products = $cartsend;
            $data->date = time();
            $data->save();
        }

        try {
            $this->telegramService = new TelegramService();
            $this->telegramService->sendMessage($send);
            $this->cartService->removeProductFromAllCart();
            return redirect()->back()->with('success', $status);
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
