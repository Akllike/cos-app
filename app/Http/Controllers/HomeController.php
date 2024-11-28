<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\ProductsService;

class HomeController extends Controller
{
    protected ProductsService $productsService;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $hairs = Products::where('category', 'hair')->get();
        $faces = Products::where('category', 'face')->get();
        $bodies = Products::where('category', 'body')->get();

        return view('home', compact('hairs', 'faces', 'bodies'));
    }

    public function create(Request $request): View
    {
        $this->productsService = new ProductsService();
        $this->productsService->CreateProduct($request);
        return $this->index();
    }

    public function edit(Request $request): View
    {
        $this->productsService = new ProductsService();
        $this->productsService->UpdateProduct($request);
        return $this->index();
    }

    public function delete(Request $request): View
    {
        $this->productsService = new ProductsService();
        $this->productsService->DeleteProduct($request);
        return $this->index();
    }

    public function inStock(Request $request): array
    {
        $this->productsService = new ProductsService();
        return $this->productsService->UpdateInStockProduct($request);
    }
}
