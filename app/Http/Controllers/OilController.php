<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OilController extends Controller
{
    public function __construct(
        protected ProductsServiceInterface $productsService
    ) {}
    public function showProductOils(): View
    {
        $data = $this->productsService->getProducts('oil');
        return view('Catalog/Faces/faces', compact('data'));
    }
}
