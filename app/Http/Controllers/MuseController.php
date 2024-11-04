<?php

namespace App\Http\Controllers;

use App\Models\Muse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MuseController extends Controller
{
    /**
     * @var array $isCreated
     * 0 - нет события | 1 - успешно | 2 - произошла какая-то ошибка. Сообщение пользователю.
     */
    public array $isCreated = [0, '0'];
    public int $isUpdated = 0;
    public int $isDeleted = 0;
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
        $alert = $this->isCreated;

        return view('Catalog/Muses/muses', compact('data', 'alert'));
        $alert = [0, '0'];
    }

    public function createMuse(): View
    {
        return view('Catalog/Muses/createMuse');
    }

    public function addCardMuse(Request $request): View
    {
        try
        {
            $data = Muse::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'composition' => $request->input('composition'),
                'volume' => (int)$request->input('volume'),
                'price' => (int)$request->input('price'),
                'image' => $request->input('image'),
            ]);

            $this->isCreated = [1, 'Карточка успешно добавлена!'];
            return $this->showProductMuses();
        }
        catch (\Exception $e)
        {
            $send = 'Произошла какая-то ошибка: ' . $e->getMessage();
            $this->isCreated = [2, $send];
            return $this->showProductMuses();
        }
    }

    /*public function editCardMuse(Request $request): Mixed
    {
        $data = Muse::find($request->input('id'));
        $data->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'composition' => $request->get('composition'),
            'volume' => (int)$request->get('volume'),
            'price' => (int)$request->get('price'),
            'image' => $request->get('image'),
        ]);

        return redirect('/')->with('update', 'Вы успешно Изменили Данные');
    }*/
}
