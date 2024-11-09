<?php

namespace App\Services;

use App\Models\Gel;
use App\Models\Muse;
use App\Models\Oil;
use App\Models\Scrab;
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
        $data = [];
        $info = (int)$request->input('group-name');
        try
        {
            if($info)
            {
                switch ($info)
                {
                    case 1:
                        $data = new Muse();
                        break;
                    case 2:
                        $data = new Gel();
                        break;
                    case 3:
                        $data = new Scrab();
                        break;
                    case 4:
                        $data = new Oil();
                        break;
                }
            }
            else
            {
                die();
            }

            if ($data) {
                $data->name = $request->input('name');
                $data->description = $request->input('description');
                $data->composition = $request->input('composition');
                $data->volume = (int)$request->input('volume');
                $data->price = (int)$request->input('price');
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
        $data = [];
        $info = (int)$request->input('group-name');
        try
        {
            switch ($info)
            {
                case 1:
                    $data = Muse::find($request->input('id'));
                    break;
                case 2:
                    $data = Gel::find($request->input('id'));
                    break;
                case 3:
                    $data = Scrab::find($request->input('id'));
                    break;
                case 4:
                    $data = Oil::find($request->input('id'));
                    break;
            }

            if ($data) {
                $data->name = $request->input('name');
                $data->description = $request->input('description');
                $data->composition = $request->input('composition');
                $data->volume = (int)$request->input('volume');
                $data->price = (int)$request->input('price');
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
        $data = [];
        $info = (int)$request->input('group-name');

        try
        {
            switch ($info)
            {
                case 1:
                    $data = Muse::find($request->input('id'));
                    break;
                case 2:
                    $data = Gel::find($request->input('id'));
                    break;
                case 3:
                    $data = Scrab::find($request->input('id'));
                    break;
                case 4:
                    $data = Oil::find($request->input('id'));
                    break;
            }

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
        $muses = Muse::where('name', 'like', '%' . $request->input('name') . '%')->get();
        $gels = Gel::where('name', 'like', '%' . $request->input('name') . '%')->get();
        $scrabs = Scrab::where('name', 'like', '%' . $request->input('name') . '%')->get();
        $oils = Oil::where('name', 'like', '%' . $request->input('name') . '%')->get();

        $data = [
            'muses' => $muses,
            'gels' => $gels,
            'scrabs' => $scrabs,
            'oils' => $oils,
        ];
        return $data;
    }
}
