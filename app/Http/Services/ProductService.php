<?php

namespace App\Http\Services;

use App\Models\Product;

class ProductService extends BaseService
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param $productId
     * @return false|mixed
     */
    public function getPriceProductByProductId($productId)
    {
        $product = $this->getById($productId);

        return optional($product)->price ?: false;
    }
}
