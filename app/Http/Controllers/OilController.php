<?php

namespace App\Http\Controllers;


use App\Models\Oil;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OilController extends Controller
{
    public function showCardOil(int $id): View
    {
        $send = [];
        $oils = Oil::all();
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
        $data = Oil::all();
        return view('Catalog/Oils/oils', compact('data'));
    }
}
