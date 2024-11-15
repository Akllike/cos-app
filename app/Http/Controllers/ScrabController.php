<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScrabController extends Controller
{
    protected ProductsService $productsService;
    public function showCardScrab(int $id): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProduct($id, 'body');
        return view('Catalog/Scrabs/showScrabs')->with('data', $data);
    }

    public function showProductScrabs(): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProducts('body');
        return view('Catalog/Scrabs/scrabs', compact('data'));
    }
}
