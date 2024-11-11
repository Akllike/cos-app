<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OilController extends Controller
{
    protected ProductsService $productsService;
    public function showCardOil(int $id): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProduct($id, 'oil');
        return view('Catalog/Oils/showOils')->with('data', $data);
    }

    public function showProductOils(): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProducts('oil');
        return view('Catalog/Oils/oils', compact('data'));
    }
}
