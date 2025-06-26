<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ProductsServiceInterface
{
    public function getProducts(string $category): mixed;
    public function getProduct(int $id): array;
    public function CreateProduct(Request $request): void;
    public function UpdateProduct(Request $request): void;
    public function DeleteProduct(Request $request): void;
    public function SearchProduct(Request $request): array;
    public function UpdateInStockProduct(Request $request): array;
}
