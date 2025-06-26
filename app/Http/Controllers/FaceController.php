<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductsServiceInterface;
use Illuminate\View\View;

class FaceController extends Controller
{
    public function __construct(
        protected ProductsServiceInterface $productsService
    ) {}
    public function showProductFaces(): View
    {
        $data = $this->productsService->getProducts('face');
        return view('Catalog/Faces/faces', compact('data'));
    }
}
