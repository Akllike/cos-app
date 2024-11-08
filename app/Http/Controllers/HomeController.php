<?php

namespace App\Http\Controllers;

use App\Models\Gel;
use App\Models\Muse;
use App\Models\Scrab;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\ProductsService;

class HomeController extends Controller
{
    protected $productsService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $muses = Muse::all();
        $gels = Gel::all();
        $scrabs = Scrab::all();

        return view('home', compact('muses', 'gels', 'scrabs'));
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
