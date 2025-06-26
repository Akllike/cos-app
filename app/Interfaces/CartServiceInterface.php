<?php

namespace App\Interfaces;

interface CartServiceInterface
{
    public function addProductToCart(int $productId, int $quantity): array;
    public function removeProductFromCart(int $productId, int $quantity): array;
    public function removeProductFromAllCart(): void;
}
