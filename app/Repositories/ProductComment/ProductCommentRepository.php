<?php

namespace App\Repositories\ProductComment;


use App\Models\ProductComment;
use App\Repositories\BaseRepository;

use App\Services\ProductComment\ProductCommentServiceInterface;

class ProductCommentRepository extends BaseRepository implements ProductCommentRepositoryInterface
{


    public function getModel()
    {
        return ProductComment::class;
    }
}
