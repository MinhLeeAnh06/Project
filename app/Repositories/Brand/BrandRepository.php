<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\BaseRepository;
use App\Services\BaseService;
use App\Services\Brand\BrandServiceInterface;

class BrandRepository extends  BaseRepository implements BrandRepositoryInterface
{

    public function getModel()
    {
        return  Brand::class;
    }
}
