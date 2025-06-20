<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BodyController extends Controller
{
    protected ProductsService $productsService;

    public function showProductBodies(): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProducts('body');
        return view('Catalog/Bodies/bodies', compact('data'));
    }
}
