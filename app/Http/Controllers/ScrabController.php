<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScrabController extends Controller
{
    public function showCardScrab(int $id): View
    {
        $send = [];
        $scrabs = Products::where('category', 'scrab')->get();
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

    public function showProductScrabs(): View
    {
        $data = Products::where('category', 'scrab')->get();
        return view('Catalog/Scrabs/scrabs', compact('data'));
    }
}
