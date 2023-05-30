<?php

namespace App\Http\Services;

use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function deleteQuantityById($productDetailId, $quantity, $status)
    {
        DB::beginTransaction();
        try {
            $productDetail = $this->where('id', $productDetailId)->first();
            $productDetail->update(['qty' => $status ? $productDetail->qty + $quantity : $productDetail->qty - $quantity]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
            return false;
        }
    }

}
