<?php

namespace App\Services;

use App\Interfaces\ProductsServiceInterface;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductsService implements ProductsServiceInterface
{
    /**
     * Получить все карточки по категории
     */
    public function getProducts(string $category): mixed
    {
        try {
            return Products::where('category', $category)->get();
        } catch (\Exception $e) {
            Log::error('Ошибка получения продуктов по категории', [
                'category' => $category,
                'error' => $e->getMessage()
            ]);
            throw new \RuntimeException('Не удалось загрузить продукты');
        }
    }

    /**
     * Получить одну карточку по id и получение 4-х карточек по категории
     */
    public function getProduct(int $id): array
    {
        try {
            $send = [];

            $items = Products::where('id', $id)->get();
            foreach ($items as $item) {
                if ($item->id == $id) {
                    $send = $item;
                }
            }

            if (empty($send)) {
                throw new ModelNotFoundException("Продукт с ID {$id} не найден");
            }

            $items = Products::where('id', $id)->take(4)->get();
            return [ 'card' => [ $send ], 'cards' => $items ];

        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Ошибка получения продукта', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            throw new \RuntimeException('Не удалось загрузить информацию о продукте');
        }
    }

    /**
     * Создать карточку продукта
     */
    public function CreateProduct(Request $request): void
    {
        DB::beginTransaction();
        try {
            $data = new Products();

            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200',
            ]);

            if($request->hasFile('photo')) {
                $path = 'storage/' . $request->file('photo')->store('cards', 'public');
            } else {
                $path = 'storage/img/logo.png';
            }

            $this->extracted($data, $request, $path);
            DB::commit();

        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ошибка создания продукта', [
                'request' => $request->all(),
                'error' => $e->getMessage()
            ]);
            throw new \RuntimeException('Не удалось создать продукт');
        }
    }

    /**
     * Обновить / редактировать карточку продукта
     */
    public function UpdateProduct(Request $request): void
    {
        DB::beginTransaction();
        try {
            $data = Products::find($request->input('id'));

            if (!$data) {
                throw new ModelNotFoundException("Продукт с ID {$request->input('id')} не найден");
            }

            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200',
            ]);

            if($request->hasFile('photo')) {
                $path = 'storage/' . $request->file('photo')->store('cards', 'public');
            } else {
                $path = $data->image;
            }

            $this->extracted($data, $request, $path);
            DB::commit();

        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw $e;
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ошибка обновления продукта', [
                'id' => $request->input('id'),
                'error' => $e->getMessage()
            ]);
            throw new \RuntimeException('Не удалось обновить продукт');
        }
    }

    /**
     * Удалить карточку продукта
     */
    public function DeleteProduct(Request $request): void
    {
        DB::beginTransaction();
        try {
            $data = Products::find($request->input('id'));

            if (!$data) {
                throw new ModelNotFoundException("Продукт с ID {$request->input('id')} не найден");
            }

            $imagePath = $data->image;
            $data->delete();

            if ($imagePath && $imagePath !== 'storage/img/logo.png') {
                $storagePath = str_replace('storage/', '', $imagePath);

                if (Storage::disk('public')->exists($storagePath)) {
                    Storage::disk('public')->delete($storagePath);
                }
            }

            DB::commit();

        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ошибка удаления продукта', [
                'id' => $request->input('id'),
                'error' => $e->getMessage()
            ]);
            throw new \RuntimeException('Не удалось удалить продукт');
        }
    }

    /**
     * Поиск карточек продуктов
     */
    public function SearchProduct(Request $request): array
    {
        try {
            $products = Products::where('name', 'like', '%' . $request->input('name') . '%')->get();
            return [ 'products' => $products ];
        } catch (\Exception $e) {
            Log::error('Ошибка поиска продуктов', [
                'query' => $request->input('name'),
                'error' => $e->getMessage()
            ]);
            throw new \RuntimeException('Не удалось выполнить поиск продуктов');
        }
    }

    /**
     * Обновление Toggle Button
     */
    public function UpdateInStockProduct(Request $request): array
    {
        DB::beginTransaction();
        try {
            $data = Products::find($request->input('id'));

            if (!$data) {
                throw new ModelNotFoundException("Продукт с ID {$request->input('id')} не найден");
            }

            if($data->popular == 0)
                $data->popular = 1;
            else
                $data->popular = 0;

            $data->save();
            DB::commit();

            return [ 'in-stock' => $data->popular ];

        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ошибка обновления статуса продукта', [
                'id' => $request->input('id'),
                'error' => $e->getMessage()
            ]);
            throw new \RuntimeException('Не удалось обновить статус продукта');
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
        try {
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
        } catch (\Exception $e) {
            Log::error('Ошибка сохранения данных продукта', [
                'error' => $e->getMessage()
            ]);
            throw new \RuntimeException('Не удалось сохранить данные продукта');
        }
    }
}
