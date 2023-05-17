<?php

namespace App\Repositories\BLog;

use App\Models\Blog;
use App\Repositories\BaseRepository;
use App\Services\BaseService;

class BLogRepository extends BaseRepository implements BlogRepositoryInterface
{

    public function getModel()
    {
        return Blog::class;
    }
    public function getLatestBlogs($limit = 3){
        return $this->model->orderBy('id','desc')
            ->limit($limit)
            ->get();
    }
}
