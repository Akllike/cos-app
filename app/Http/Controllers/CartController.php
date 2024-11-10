<?php

namespace App\Http\Controllers;

use App\Models\Scrab;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    // Получение списка товаров в корзине
    public function index(Request $request): View
    {
        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }

    // Добавление товара в корзину
    public function add(Request $request): View
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Допустим, у нас есть метод для получения информации о товаре
            $product = $this->getProductById($productId);
            $cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);

        return view('cart')->with('cart', $cart);
    }

    // Удаление товара из корзины
    public function remove(Request $request): View
    {
        $productId = $request->input('product_id');

        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return view('cart')->with('cart', $cart);
    }

    // Метод для получения информации о товаре, модель Product
    protected function getProductById($productId)
    {
        return Scrab::find($productId);
    }
}
