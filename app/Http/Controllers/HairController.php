<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductsServiceInterface;
use Illuminate\View\View;

class HairController extends Controller
{
    public function __construct(
        private ProductsServiceInterface $productsService
    )
    {}
    public function showProductHairs(): View
    {
        $data = $this->productsService->getProducts('hair');
        return view('Catalog/Hairs/hairs', compact('data'));
    }
}
