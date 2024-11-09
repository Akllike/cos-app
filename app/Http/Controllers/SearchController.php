<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    protected $productsService;

    public function __invoke(): View
    {
        return view('search');
    }

    public function viewSearch(Request $request): View
    {
        $this->productsService = new ProductsService();
        $data = $this->productsService->SearchProduct($request);
        $muses = $data['muses']; $gels = $data['gels']; $scrabs = $data['scrabs']; $oils = $data['oils'];

        $title = 'Результаты поиска - ' . $request->input('name') . ' | ShaR';

        return view('search', compact('muses', 'gels', 'scrabs', 'title'));
    }
}
