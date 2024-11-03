<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
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
}
