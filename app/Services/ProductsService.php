<?php

namespace App\Services;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsService
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
     * @param string $category
     * @return array
     */
    public function getProduct(int $id, string $category): array
    {
        $send = [];

        $items = Products::where('category', $category)->get();
        foreach ($items as $item) {
            if ($item->id == $id) {
                $send = $item;
            }
        }

        $items = Products::where('category', $category)->take(4)->get();
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
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->file('photo')->isValid())
                $path = 'storage/' . $request->file('photo')->store('cards', 'public');
            //dd($path);
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

            if ($data) {
                $data->name = $request->input('name');
                $data->description = $request->input('description');
                $data->composition = $request->input('composition');
                $data->volume = (int)$request->input('volume');
                $data->price = (int)$request->input('price');
                $data->category = $request->input('group-name');
                $data->article = 0;
                //$data->image = $request->input('image');
                $data->save();
            }
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

        $data = [
            'products' => $products,
        ];
        return $data;
    }
}
