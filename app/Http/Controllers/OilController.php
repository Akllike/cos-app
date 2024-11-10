<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OilController extends Controller
{
    public function showCardOil(int $id): View
    {
        $send = [];
        $oils = Products::where('category', 'oil')->get();
        foreach ($oils as $oil) {
            if ($oil->id == $id) {
                $send = $oil;
            }
        }

        $data = [
            'card' => [
                $send,
            ],
            'cards' => $oils,
        ];
        //dd($data[$id]['name']);
        return view('Catalog/Oils/showOils')->with('data', $data);
    }

    public function showProductOils(): View
    {
        $data = Products::where('category', 'oil')->get();
        return view('Catalog/Oils/oils', compact('data'));
    }
}
