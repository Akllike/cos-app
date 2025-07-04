<?php

namespace App\Services;

use App\Interfaces\ProductsServiceInterface;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsService implements ProductsServiceInterface
{
    /**
     * Получить все карточки по категории
     *
     * @param string $category
     * @return mixed
     */
    public function getProducts(string $category): mixed
    {
        return Products::where('category', $category)->get();
    }

    /**
     * Получить одну карточку по id и получение 4-х карточек по категории
     *
     * @param int $id
     * @return array
     */
    public function getProduct(int $id): array
    {
        $send = [];

        $items = Products::where('id', $id)->get();
        foreach ($items as $item) {
            if ($item->id == $id) {
                $send = $item;
            }
        }

        $items = Products::where('id', $id)->take(4)->get();
        return [ 'card' => [ $send ], 'cards' => $items ];
    }

    /**
     * Создать карточку продукта
     *
     * @param Request $request
     * @return void
     */
    public function CreateProduct(Request $request): void
    {
        try
        {
            $data = new Products();

            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200',
            ]);

            if($request->hasFile('photo'))
            {
                //if ($request->file('photo')->isValid())
                $path = 'storage/' . $request->file('photo')->store('cards', 'public');
            }
            else
            {
                $path = 'storage/img/logo.png';
            }
            //dd($path);
            $this->extracted($data, $request, $path);
        }
        catch (\Exception $e)
        {
            $send = 'Произошла какая-то ошибка: ' . $e->getMessage();
            dd($send);
        }
    }

    /**
     * Обновить / редактировать карточку продукта
     *
     * @param Request $request
     * @return void
     */
    public function UpdateProduct(Request $request): void
    {
        try
        {
            $data = Products::find($request->input('id'));
            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if($request->hasFile('photo'))
            {
                //if ($request->file('photo')->isValid())
                $path = 'storage/' . $request->file('photo')->store('cards', 'public');
            }
            else
            {
                $path = $data->image;
            }

            $this->extracted($data, $request, $path);
        }
        catch (\Exception $e)
        {
            $send = 'Произошла какая-то ошибка: ' . $e->getMessage();
            dd($send);
        }
    }

    /**
     * Удалить карточку продукта
     *
     * @param Request $request
     * @return void
     */
    public function DeleteProduct(Request $request): void
    {
        try
        {
            $data = Products::find($request->input('id'));

            if ($data) {
                $data->delete();
            }
        }
        catch (\Exception $e)
        {
            $send = 'Произошла какая-то ошибка: ' . $e->getMessage();
            dd($send);
        }
    }

    /**
     * Поиск карточек продуктов
     *
     * @param Request $request
     * @return array
     */
    public function SearchProduct(Request $request): array
    {
        $products = Products::where('name', 'like', '%' . $request->input('name') . '%')->get();

        return [ 'products' => $products ];
    }

    /**
     * Обновление Toggle Button
     *
     * @param Request $request
     * @return int[]
     */
    public function UpdateInStockProduct(Request $request): array
    {
        try
        {
            $data = Products::find($request->input('id'));

            if ($data) {
                if($data->popular == 0)
                    $data->popular = 1;
                else
                    $data->popular = 0;

                $data->save();
            }

            return [ 'in-stock' => $data->popular ];
        }
        catch (\Exception $e)
        {
            $send = 'Произошла какая-то ошибка: ' . $e->getMessage();
            dd($send);
        }
    }

    /**
     * @param $data
     * @param Request $request
     * @param string $path
     * @return void
     */
    public function extracted($data, Request $request, string $path): void
    {
        if ($data) {
            $data->name = $request->input('name');
            $data->description = $request->input('description');
            $data->composition = $request->input('composition');
            $data->volume = (int)$request->input('volume');
            $data->price = (int)$request->input('price');
            $data->category = $request->input('group-name');
            $data->article = 0;
            $data->image = $path;
            $data->save();
        }
    }
}
