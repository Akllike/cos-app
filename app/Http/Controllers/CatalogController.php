<?php

namespace App\Http\Controllers;

use App\Interfaces\CommentsServiceInterface;
use App\Interfaces\ProductsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class CatalogController extends Controller
{
    public function __construct(
        protected CommentsServiceInterface $commentsService,
        protected ProductsServiceInterface $productsService
    ) {}

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
        $data = $this->productsService->getProduct($id);
        $comments = $this->commentsService->getComments($id);

        return view('Catalog/product')->with('data', $data)->with('comments', $comments);
    }

    public function createComment(int $id, Request $request): RedirectResponse
    {
        $this->commentsService->createComment($request);
        return redirect()->route('product.card', ['id' => $id]);
    }
}
