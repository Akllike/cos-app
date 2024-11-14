<?php

namespace App\Services;

use App\Models\Products;

class CartService
{
    public function addProductToCart(int $productId, int $quantity): array
    {
        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = $this->getProductById($productId);
            $cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'category' => $product->category,
                'quantity' => $quantity,
            ];
        }

        return $cart;
    }

    public function removeProductFromCart(int $productId): array
    {
        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return $cart;
    }

    protected function getProductById(int $productId)
    {
        return Products::find($productId);
    }
}
