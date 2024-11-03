<?php

namespace App\Http\Controllers;

use App\Models\Gel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GelController extends Controller
{
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

    public function showProductGels(): View
    {
        $data = Gel::all();
        return view('Catalog/Gels/gels', compact('data'));
    }

    public function createGel(): View
    {
        return view('Catalog/Gels/createGel');
    }

    public function addCardGel(Request $request): View
    {
        $data = Gel::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'composition' => $request->input('composition'),
            'volume' => (int)$request->input('volume'),
            'price' => (int)$request->input('price'),
            'image' => $request->input('image'),
        ]);

        return $this->showProductGels();
    }
}
