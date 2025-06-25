<?php

namespace App\Services;
namespace App\Models\Comments;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsService
{
    public function getComments(int $productId): mixed
    {
        return Comments::where('product_id', $productId)->orderBy('created_at', 'DESC')->paginate(10);
    }

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
            $send = 'Произошла какая-то ошибка: ' . $e->getMessage();
        }
    }

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
