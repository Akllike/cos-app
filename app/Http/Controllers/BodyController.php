<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BodyController extends Controller
{
    public function __construct(
        protected ProductsServiceInterface $productsService
    ) {}

    public function showProductBodies(): View
    {
        $data = $this->productsService->getProducts('body');
        return view('Catalog/Bodies/bodies', compact('data'));
    }
}
