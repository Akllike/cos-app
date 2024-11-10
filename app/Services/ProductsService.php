<?php

namespace App\Services;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsService
{
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

            if ($data) {
                $data->name = $request->input('name');
                $data->description = $request->input('description');
                $data->composition = $request->input('composition');
                $data->volume = (int)$request->input('volume');
                $data->price = (int)$request->input('price');
                $data->category = $request->input('group-name');
                $data->article = 0;
                $data->image = $request->input('image');
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
                $data->image = $request->input('image');
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
