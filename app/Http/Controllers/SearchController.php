<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __construct(
        protected ProductsServiceInterface $productsService
    ) {}

    public function __invoke(): View
    {
        return view('search');
    }

    public function viewSearch(Request $request): View
    {
        $data = $this->productsService->SearchProduct($request);
        $products = $data['products'];

        $title = 'Результаты поиска - ' . $request->input('name') . ' | ShaR';

        return view('search', compact('products', 'title'));
    }
}
