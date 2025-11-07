<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductsServiceInterface;
use \Illuminate\Http\RedirectResponse;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(protected ProductsServiceInterface $productsService)
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $hairs = Products::where('category', 'hair')->get();
        $faces = Products::where('category', 'face')->get();
        $bodies = Products::where('category', 'body')->get();
        $oils = Products::where('category', 'oil')->get();
        $certificates = Products::where('category', 'certificate')->get();

        return view('home', compact('hairs', 'faces', 'bodies', 'oils', 'certificates'));
    }

    public function create(Request $request): RedirectResponse
    {
        $this->productsService->CreateProduct($request);
        return redirect()->route('home');
    }

    public function edit(Request $request): RedirectResponse
    {
        $this->productsService->UpdateProduct($request);
        return redirect()->route('home');
    }

    public function delete(Request $request): RedirectResponse
    {
        $this->productsService->DeleteProduct($request);
        return redirect()->route('home');
    }

    public function order(): View
    {
        $data = Orders::orderBy('id', 'DESC')->take(10)->get();

        return view('orders', compact('data'));
    }

    public function inStock(Request $request): array
    {
        return $this->productsService->UpdateInStockProduct($request);
    }
}
