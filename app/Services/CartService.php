<?php

namespace App\Services;

use App\Models\Products;

/**
 * Сервис для работы с корзиной
 * - Добавить в корзину
 * - Удалить с корзины одну позицию
 * - Удалить с корзины все позиции
 */
class CartService
{
    /**
     * Добавление карточки продукта в сессию
     *
     * @param int $productId ID карточки
     * @param int $quantity Количество одного товара
     * @return array
     */
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

    /**
     * Удаление одной карточки с сессии
     *
     * @param int $productId ID карточки
     * @param int $quantity
     * @return array
     */
    public function removeProductFromCart(int $productId, int $quantity): array
    {
        $cart = session('cart', []);

        if($quantity == 0){
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session(['cart' => $cart]);
            }
        }
        else
        {
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] -= $quantity;
                if($cart[$productId]['quantity'] <= 0) {
                    unset($cart[$productId]);
                    session(['cart' => $cart]);
                }
                session(['cart' => $cart]);
            }
        }
        return $cart;
    }
    /**
     * Удаление всех карточек с сессии
     *
     * @return void
     */
    public function removeProductFromAllCart(): void
    {
        $cart = session('cart', []);

        if (isset($cart)) {
            array_splice($cart, 0);
            session(['cart' => $cart]);
        }
    }

    /**
     * Получение ID карточки с базы данных
     *
     * @param int $productId ID карточки
     * @return mixed
     */
    protected function getProductById(int $productId): mixed
    {
        return Products::find($productId);
    }
}
