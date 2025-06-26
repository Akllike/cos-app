<?php

namespace App\Services;

use App\Interfaces\CommentsServiceInterface;
use App\Models\Comments;
use Illuminate\Http\Request;

/**
 * Сервис для работы с отзывами для товара
 *
 * - Получить список отзывов по id продукта
 * - Создать отзыв по id продукта
 */
class CommentsService implements CommentsServiceInterface
{
    /**
     * Получение списка отзывов по id продукта
     *
     * @param int $productId
     * @return mixed
     */
    public function getComments(int $productId): mixed
    {
        return Comments::where('product_id', $productId)->orderBy('created_at', 'DESC')->paginate(10);
    }

    /**
     * Создание отзыва по id продукта
     *
     * @param Request $request
     * @return void
     */
    public function createComment(Request $request): void
    {
        $data = new Comments();

        try
        {
            if(!empty($request->input('name')) && !empty($request->input('email')) && !empty($request->input('comment')))
            {
                $this->extracted($data, $request);
            }
        }
        catch (\Exception $e)
        {
            throw new \RuntimeException('Ошибка при создании комментария: ' . $e->getMessage());
        }
    }

    /**
     * @param $data
     * @param Request $request
     * @return void
     */
    public function extracted($data, Request $request): void
    {
        if ($data) {
            $data->name = $request->input('name');
            $data->product_id = $request->input('product_id');
            $data->email = $request->input('email');
            $data->comment = $request->input('comment');
            $data->rating = (int)$request->input('rating');
            $data->save();
        }
    }
}
