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
        $muses = Products::where('category', 'muse')->get();
        $gels = Products::where('category', 'gel')->get();
        $scrabs = Products::where('category', 'scrab')->get();
        $oils = Products::where('category', 'oil')->get();

        return view('home', compact('muses', 'gels', 'scrabs', 'oils'));
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
}
