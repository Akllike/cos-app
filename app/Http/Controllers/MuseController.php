<?php

namespace App\Http\Controllers;

use App\Models\Muse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MuseController extends Controller
{
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

    public function showProductMuses(): View
    {
        $data = Muse::all();
        return view('Catalog/Muses/muses', compact('data'));
    }

    public function createMuse(): View
    {
        return view('Catalog/Muses/createMuse');
    }

    public function addCardMuse(Request $request): View
    {
        $data = Muse::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'composition' => $request->input('composition'),
            'volume' => (int)$request->input('volume'),
            'price' => (int)$request->input('price'),
            'image' => $request->input('image'),
        ]);

        return $this->showProductMuses();
    }
}
