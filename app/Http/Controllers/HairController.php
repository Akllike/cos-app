<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HairController extends Controller
{
    protected ProductsService $productsService;
    public function showCardHairs(int $id): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProduct($id, 'hair');
        return view('Catalog/Hairs/showHairs')->with('data', $data);
    }

    public function showProductHairs(): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProducts('hair');
        return view('Catalog/Hairs/hairs', compact('data'));
    }
}
