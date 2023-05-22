<?php

namespace App\Http\Services;

use App\Models\ProductDetail;

class ProductDetailService extends BaseService
{
    public function __construct(ProductDetail $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @return false|\Illuminate\Support\Optional|mixed
     */
    public function getDataProductDetail($data) {
        $dataCheck = [
            ['product_id', $data['productId']],
            ['color', $data['color']],
            ['size', $data['size']]
        ];

        $productDetail = $this->model->where($dataCheck)->first();

        return optional($productDetail) ?: false;
    }

}
