<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MuseController extends Controller
{
    protected ProductsService $productsService;
    public function showCardMuse(int $id): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProduct($id, 'muse');
        return view('Catalog/Muses/showMuses')->with('data', $data);
    }

    public function showProductMuses(): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProducts('muse');
        return view('Catalog/Muses/muses', compact('data'));
    }
}
