<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\View\View;

class CatalogController extends Controller
{
    protected ProductsService $productsService;
    public function __invoke(): View
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Муссы',
                'description' => 'Муссы из натуральных масел',
            ],
            [
                'id' => 2,
                'name' => 'Скрабы',
                'description' => 'Скрабы для тела с маслами, крем-скрабы для тела, холодные скрабы',
            ],
            [
                'id' => 3,
                'name' => 'Бальзамы',
                'description' => 'Бальзамы для губ',
            ],
        ];
        return view('Catalog/catalog')->with('products', $products);
    }

    public function showProduct(int $id): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProduct($id);
        return view('Catalog/product')->with('data', $data);
    }
}
