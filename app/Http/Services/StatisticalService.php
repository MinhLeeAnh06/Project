<?php

namespace App\Http\Services;

use App\Models\Statistical;
use Illuminate\Support\Facades\DB;

class StatisticalService extends BaseService
{
    public function __construct(Statistical $model)
    {
        $this->model = $model;
    }

    /**
     * Doanh thu theo thời gian
     * Default : Doanh thu từ đầu tháng đến thời gian hiện tại
     * @param $arrTime
     * @return mixed
     */
    public function getRevenueByTime($arrTime)
    {
        $results = $this->model->select(DB::raw('DATE(day) as time'),
            DB::raw('SUM(revenue) AS total_amount'))
            ->whereBetween('day', $arrTime)
            ->groupBy('time')
            ->get();

        return $results;
    }

    /**
     * Doanh thu các tháng trong năm
     * @return mixed
     */
    public function getRevenueByTimeMonth()
    {
        $results = $this->model->whereYear('day', now()->year)
            ->select(DB::raw('MONTH(day) as time'), DB::raw('SUM(revenue) AS total_amount'))
            ->groupBy('time')
            ->get();

        return $results;
    }

    /**
     * Doanh thu các năm
     * @return mixed
     */
    public function getRevenueByTimeYear()
    {
        $results = $this->model->select(DB::raw('YEAR(day) as time'), DB::raw('SUM(revenue) AS total_amount'))
            ->groupBy('time')
            ->get();

        return $results;
    }

    /**
     * Trạng thái order theo thời gian
     * Default : Trạng thái order từ đầu tháng đến thời gian hiện tại
     * @return mixed
     */
    public function getOrderByTime($arrTime)
    {
        $results = $this->model->select(DB::raw('DATE(day) as time'),
            DB::raw('SUM(delivering_order) AS delivering_order'),
            DB::raw('SUM(success_order) AS success_order'),
            DB::raw('SUM(cancel_order) AS cancel_order'),)
            ->whereBetween('day', $arrTime)
            ->groupBy('time')
            ->get();

        return $results;
    }

    /**
     * Trạng thái order các tháng
     * @return mixed
     */
    public function getOrderByTimeMonth()
    {
        $results = $this->model->whereYear('day', now()->year)
            ->select(DB::raw('MONTH(day) as time'),
                DB::raw('SUM(delivering_order) AS delivering_order'),
                DB::raw('SUM(success_order) AS success_order'),
                DB::raw('SUM(cancel_order) AS cancel_order'),)
            ->groupBy('time')
            ->get();

        return $results;
    }

    /**
     * Trạng thái order các năm
     * @return mixed
     */
    public function getOrderByTimeYear()
    {
        $results = $this->model->select(DB::raw('YEAR(day) as time'),
            DB::raw('SUM(delivering_order) AS delivering_order'),
            DB::raw('SUM(success_order) AS success_order'),
            DB::raw('SUM(cancel_order) AS cancel_order'),)
            ->groupBy('time')
            ->get();

        return $results;
    }

    public function getDataByDay() {
        return $this->model->where('day', now()->format('Y-m-d'))->first();
    }
}
