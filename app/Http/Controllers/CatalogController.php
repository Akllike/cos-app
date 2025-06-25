<?php

namespace App\Http\Controllers;

use App\Models\Comments\CommentsService;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class CatalogController extends Controller
{
    protected ProductsService $productsService;
    protected CommentsService $commentsService;
    public function __invoke(): View
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Муссы',
                'description' => 'Муссы из натуральных масел',
            ],
            [
                'id' => 2,
                'name' => 'Скрабы',
                'description' => 'Скрабы для тела с маслами, крем-скрабы для тела, холодные скрабы',
            ],
            [
                'id' => 3,
                'name' => 'Бальзамы',
                'description' => 'Бальзамы для губ',
            ],
        ];
        return view('Catalog/catalog')->with('products', $products);
    }

    public function showProduct(int $id): View
    {
        $this->productsService = new ProductsService();
        $this->commentsService = new CommentsService();
        $data = $this->productsService->getProduct($id);
        $comments = $this->commentsService->getComments($id);

        return view('Catalog/product')->with('data', $data)->with('comments', $comments);
    }

    public function createComment(int $id, Request $request): RedirectResponse
    {
        $this->commentsService = new CommentsService();
        $this->commentsService->createComment($request);
        return redirect()->route('product.card', ['id' => $id]);
    }
}
