<?php

namespace App\Http\Controllers;

use App\Models\Scrab;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScrabController extends Controller
{
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

    public function showProductScrabs(): View
    {
        $data = Scrab::all();
        return view('Catalog/Scrabs/scrabs', compact('data'));
    }

    public function createScrab(): View
    {
        return view('Catalog/Scrabs/createScrab');
    }

    public function addCardScrab(Request $request): View
    {
        $data = Scrab::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'composition' => $request->input('composition'),
            'volume' => (int)$request->input('volume'),
            'price' => (int)$request->input('price'),
            'image' => $request->input('image'),
        ]);

        return $this->showProductScrabs();
    }
}
