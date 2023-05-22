<?php

namespace App\Http\Services;

use App\Models\ShoppingSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShoppingSessionService extends BaseService
{
    public function __construct(ShoppingSession $model)
    {
        $this->model = $model;
    }

    /**
     * @param $sessionId
     * @return void
     */
    public function updateAmountShoppingSession($sessionId)
    {
        $shoppingSession = $this->getById($sessionId);
        $shoppingSession->update(['amount' => $shoppingSession->carts()->count()]);
    }

    /**
     * @param $userId
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function storeShoppingSession($userId = 0)
    {
        DB::beginTransaction();
        try {
            $shoppingSession = $this->create([
                'user_id' => $userId,
                'amount'  => 1
            ]);

            if (!$userId && empty($_COOKIE['session_cart'])) $this->setCookieShoppingSession($shoppingSession->id);

            DB::commit();

            return $shoppingSession;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");

            return false;
        }
    }

    /**
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function checkExistShoppingSession($user_id) {
        $shoppingSession = $this->where('user_id', $user_id)->first();

        return $shoppingSession;
    }

    /**
     * @param $sessionId
     * @return void
     */
    private function setCookieShoppingSession($sessionId)
    {
        Cookie::queue('session_cart', $sessionId, $this->model::TIME_COOKIE_VIEWED_TO_EXIST);
    }

    /**
     * @param $sessionId
     * @return void
     */
    public function deleteShoppingSession($sessionId)
    {
        $shoppingSession = $this->getById($sessionId);
        $shoppingSession->delete();
        Cookie::queue(Cookie::forget('session_cart'));
    }

    public function deleteShoppingSessionByAmount()
    {
        $this->model->where('amount', 0)->delete();
    }
}
