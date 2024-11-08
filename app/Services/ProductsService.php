<?php

namespace App\Services;

use App\Models\Gel;
use App\Models\Muse;
use App\Models\Scrab;
use Illuminate\Http\Request;

class ProductsService
{
    public function CreateProduct(Request $request): void
    {
        $data = [];
        $info = (int)$request->input('group-name');
        try
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
}
