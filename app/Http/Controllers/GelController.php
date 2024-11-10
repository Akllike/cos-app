<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GelController extends Controller
{
    public function showCardGel(int $id): View
    {
        $send = [];
        $gels = Products::where('category', 'gel')->get();
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

    public function showProductGels(): View
    {
        $data = Products::where('category', 'gel')->get();
        return view('Catalog/Gels/gels', compact('data'));
    }
}
