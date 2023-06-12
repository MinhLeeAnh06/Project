<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function deleteQuantityById($productId, $quantity, $status)
    {
        DB::beginTransaction();
        try {
            $productDetail = $this->where('id', $productId)->first();
            $productDetail->update(['qty' => $status ? $productDetail->qty - $quantity : $productDetail->qty + $quantity]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
            return false;
        }
    }
}
