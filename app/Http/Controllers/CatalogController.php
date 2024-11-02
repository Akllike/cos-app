<?php

namespace App\Http\Controllers;

use App\Models\Gel;
use App\Models\Muse;
use App\Models\Scrab;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
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

    public function showProductMuses(): View
    {
        $data = Muse::all();
        return view('Catalog/Muses/muses', compact('data'));
    }

    public function showProductScrabs(): View
    {
        $data = Scrab::all();
        return view('Catalog/Scrabs/scrabs', compact('data'));
    }

    public function showProductGels(): View
    {
        $data = Gel::all();
        return view('Catalog/Gels/gels', compact('data'));
    }

    public function showCardMuse(int $id): View
    {
        $send = [];
        $muses = Muse::all();
        foreach ($muses as $muse) {
            if ($muse->id == $id) {
                $send = $muse;
            }
        }

        $data = [
            'card' => [
                $send,
            ],
            'cards' => $muses,
        ];
        //dd($data[$id]['name']);
        return view('Catalog/Muses/showMuses')->with('data', $data);
    }

    public function showCardGel(int $id): View
    {
        $send = [];
        $gels = Gel::all();
        foreach ($gels as $gel) {
            if ($gel->id == $id) {
                $send = $gel;
            }
        }

        $data = [
            'card' => [
                $send,
            ],
            'cards' => $gels,
        ];
        //dd($data[$id]['name']);
        return view('Catalog/Gels/showGels')->with('data', $data);
    }

    public function showCardScrab(int $id): View
    {
        $send = [];
        $scrabs = Scrab::all();
        foreach ($scrabs as $scrab) {
            if ($scrab->id == $id) {
                $send = $scrab;
            }
        }

        $data = [
            'card' => [
                $send,
            ],
            'cards' => $scrabs,
        ];
        //dd($data[$id]['name']);
        return view('Catalog/Scrabs/showScrabs')->with('data', $data);

    }
}
