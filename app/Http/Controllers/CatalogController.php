<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CatalogInterface;
use Illuminate\View\View;

class CatalogController extends Controller implements CatalogInterface
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
        $muses = $this->addMuses();
        return view('Catalog/Muses/muses')->with('muses', $muses);
    }

    public function showProductScrabs(): View
    {
        $scrabs = $this->addScrabs();
        return view('Catalog/Scrabs/scrabs')->with('scrabs', $scrabs);
    }

    public function showProductGels(): View
    {
        $gels = $this->addGels();
        return view('Catalog/Gels/gels')->with('gels', $gels);
    }

    public function showCardMuse(int $id): View
    {
        $muses = $this->addMuses();
        $data = [
            'card' => [
                $muses[$id],
            ],
            'cards' => $muses,
        ];

        //dd($data);
        return view('Catalog/Muses/showMuses')->with('data', $data);

    }

    public function showCardGel(int $id): View
    {
        $gels = $this->addGels();
        //dd($muses[$id]['name']);
        return view('Catalog/Gels/showGels')->with('gels', $gels[$id]);

    }

    public function showCardScrab(int $id): View
    {
        $scrabs = $this->addScrabs();
        //dd($muses[$id]['name']);
        return view('Catalog/Scrabs/showScrabs')->with('scrabs', $scrabs[$id]);

    }

    /*
     * Массив данных мусс
     */
    public function addMuses(): array
    {
        $data = [
            1 =>
            [
                'id' => 1,
                'name' => 'Мусс для волос',
                'description' => 'Мусс для волос, мусс для волос',
                'composition' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt eaque eius exercitationem fugit minus nemo non nulla quis reiciendis sequi? Amet aut cupiditate magni mollitia officiis saepe, sint temporibus voluptate.',
                'volume' => 250,
                'price' => '1000',
                'image' => '',
                'popular' => 1
            ],

            2 =>
            [
                'id' => 2,
                'name' => 'Мусс для тела',
                'description' => 'Мусс для тела, мусс для тела',
                'composition' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt eaque eius exercitationem fugit minus nemo non nulla quis reiciendis sequi? Amet aut cupiditate magni mollitia officiis saepe, sint temporibus voluptate.',
                'volume' => 200,
                'price' => '1500',
                'image' => '',
                'popular' => 1
            ],

            3 =>
            [
                'id' => 3,
                'name' => 'Мусс для тела с холодком',
                'description' => 'Мусс для тела с холодком, мусс для тела с холодком',
                'composition' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt eaque eius exercitationem fugit minus nemo non nulla quis reiciendis sequi? Amet aut cupiditate magni mollitia officiis saepe, sint temporibus voluptate.',
                'volume' => 350,
                'price' => '1500',
                'image' => '',
                'popular' => 1
            ],

            4 =>
            [
                'id' => 4,
                'name' => 'Мусс для тела с маслами',
                'description' => 'Мусс для тела с маслами, мусс для тела с маслами',
                'composition' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt eaque eius exercitationem fugit minus nemo non nulla quis reiciendis sequi? Amet aut cupiditate magni mollitia officiis saepe, sint temporibus voluptate.',
                'volume' => 300,
                'price' => '1800',
                'image' => '',
                'popular' => 0
            ],
        ];
        return $data;
    }

    /*
     * Массив данных скраб
     */
    public function addScrabs(): array
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Скраб для волос',
                'description' => 'Скраб для волос, Скраб для волос',
                'price' => 1000,
                'image' => '',
                'popular' => 1
            ],
            [
                'id' => 2,
                'name' => 'Скраб для тела',
                'description' => 'Скраб для тела, Скраб для тела',
                'price' => 1500,
                'image' => '',
                'popular' => 1
            ],
            [
                'id' => 3,
                'name' => 'Скраб для тела с холодком',
                'description' => 'Скраб для тела с холодком, Скраб для тела с холодком',
                'price' => 1500,
                'image' => '',
                'popular' => 1
            ],
            [
                'id' => 4,
                'name' => 'Скраб для тела с маслами',
                'description' => 'Скраб для тела с маслами, Скраб для тела с маслами',
                'price' => 1800,
                'image' => '',
                'popular' => 0
            ],
            [
                'id' => 5,
                'name' => 'Скраб для тела с маслами',
                'description' => 'Скраб для тела с маслами, Скраб для тела с маслами',
                'price' => 1800,
                'image' => '',
                'popular' => 0
            ],
            [
                'id' => 6,
                'name' => 'Скраб для тела с маслами',
                'description' => 'Скраб для тела с маслами, Скраб для тела с маслами',
                'price' => 1800,
                'image' => '',
                'popular' => 0
            ],
        ];
        return $data;
    }

    /*
     * Массив данных гель
     */
    public function addGels(): array
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Гель для волос',
                'description' => 'Гель для волос, Гель для волос',
                'price' => 1000,
                'image' => '',
                'popular' => 1
            ],
            [
                'id' => 2,
                'name' => 'Гель для тела',
                'description' => 'Гель для тела, Гель для тела',
                'price' => 1500,
                'image' => '',
                'popular' => 1
            ],
            [
                'id' => 3,
                'name' => 'Гель для тела с холодком',
                'description' => 'Гель для тела с холодком, Гель для тела с холодком',
                'price' => 1500,
                'image' => '',
                'popular' => 1
            ],
            [
                'id' => 4,
                'name' => 'Гель для тела с маслами',
                'description' => 'Гель для тела с маслами, Гель для тела с маслами',
                'price' => 1800,
                'image' => '',
                'popular' => 0
            ],
            [
                'id' => 5,
                'name' => 'Гель для тела с маслами',
                'description' => 'Гель для тела с маслами, Гель для тела с маслами',
                'price' => 1800,
                'image' => '',
                'popular' => 0
            ],
            [
                'id' => 6,
                'name' => 'Гель для тела с маслами',
                'description' => 'Гель для тела с маслами, Гель для тела с маслами',
                'price' => 1800,
                'image' => '',
                'popular' => 0
            ],
        ];
        return $data;
    }
}
