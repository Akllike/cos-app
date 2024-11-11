<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    protected ProductsService $productsService;

    public function __invoke(): View
    {
        return view('search');
    }

    public function viewSearch(Request $request): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->SearchProduct($request);
        $products = $data['products'];

        $title = 'Результаты поиска - ' . $request->input('name') . ' | ShaR';

        return view('search', compact('products', 'title'));
    }
}
