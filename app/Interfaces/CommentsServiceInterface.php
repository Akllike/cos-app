<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
interface CommentsServiceInterface
{
    public function getComments(int $productId): mixed;
    public function createComment(Request $request): void;
}
