<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaceController extends Controller
{
    protected ProductsService $productsService;

    public function showProductFaces(): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->getProducts('face');
        return view('Catalog/Faces/faces', compact('data'));
    }
}
