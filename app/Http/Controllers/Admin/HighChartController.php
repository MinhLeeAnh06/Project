<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\OrderService;
use App\Http\Services\ProductDetailService;
use App\Http\Services\StatisticalService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HighChartController extends Controller
{
    protected $orderService;
    protected $statisticalService;
    protected $productDetailService;
    public function __construct(
        OrderService $orderService,
        StatisticalService $statisticalService,
        ProductDetailService $productDetailService
    ) {
        $this->orderService = $orderService;
        $this->statisticalService = $statisticalService;
        $this->productDetailService = $productDetailService;
    }

    public function getDataSalesStatistics(Request $request)
    {
        if (count($request->all())) {
            switch ($request->type) {
                case 2:
                    $data = $this->statisticalService->getRevenueByTimeMonth()->toArray();
                    $dataText = $this->getTextChart(2);
                    break;
                case 3:
                    $data = $this->statisticalService->getRevenueByTimeYear()->toArray();
                    $dataText = $this->getTextChart(3);
                    break;
                case 4:
                    $splitArray = explode('-', $request->date);
                    $firstDate = Carbon::parse($splitArray[0])->format('Y-m-d');
                    $toDate = Carbon::parse($splitArray[1])->format('Y-m-d');
                    $arrTime = [$firstDate, $toDate];

                    $data = $this->statisticalService->getRevenueByTime($arrTime)->toArray();
                    $dataText = $this->getTextChart($request->type, $splitArray[0], $splitArray[1]);
                    break;
                default:
                    $dataText = $this->getTextChart($request->type);
                    break;
            }

            return response()->json([
                'data' => $data,
                'dataText' => $dataText,
            ]);

        }

        $timeEndOfDay = now()->format('Y-m-d');
        $timeStartOfDay = now()->startOfMonth()->format('Y-m-d');
        $arrTime = [$timeStartOfDay, $timeEndOfDay];
        $data = $this->statisticalService->getRevenueByTime($arrTime)->toArray();
        $dataText = $this->getTextChart(1);
        return view('chart.chart_sales_statistics', compact('data', 'dataText'));
    }

    public function getOrderSalesStatistics(Request $request)
    {
        if (count($request->all())) {
            switch ($request->type) {
                case 7:
                    $data = $this->statisticalService->getOrderByTimeMonth()->toArray();
                    $dataText = $this->getTextChart(7);

                    $productDetails = $this->productDetailService->all();
                    $view = view('render.chart.tbl_product_detail', compact('productDetails'))->render();
                    break;
                case 8:
                    $data = $this->statisticalService->getOrderByTimeYear()->toArray();
                    $dataText = $this->getTextChart(8);

                    $productDetails = $this->productDetailService->all();
                    $view = view('render.chart.tbl_product_detail', compact('productDetails'))->render();
                    break;
                case 6:
                    $splitArray = explode('-', $request->date);
                    $firstDate = Carbon::parse($splitArray[0])->format('Y-m-d');
                    $toDate = Carbon::parse($splitArray[1])->format('Y-m-d');
                    $arrTime = [$firstDate, $toDate];

                    $data = $this->statisticalService->getOrderByTime($arrTime)->toArray();
                    $dataText = $this->getTextChart($request->type, $splitArray[0], $splitArray[1]);

                    $productDetails = $this->productDetailService->all();
                    $view = view('render.chart.tbl_product_detail', compact('productDetails'))->render();
                    break;
                default:
                    $dataText = $this->getTextChart($request->type);
                    break;
            }

            return response()->json([
                'data' => $data,
                'dataText' => $dataText,
                'view' => $view
            ]);

        }
        $timeEndOfDay = now()->format('Y-m-d');
        $timeStartOfDay = now()->startOfMonth()->format('Y-m-d');
        $arrTime = [$timeStartOfDay, $timeEndOfDay];
        $data = $this->statisticalService->getOrderByTime($arrTime)->toArray();
        $productDetails = $this->productDetailService->all();
        $dataText = $this->getTextChart(5);
        $dataStatistical = $this->statisticalService->getDataByDay();
        return view('chart.chart_order_statistics', compact('productDetails', 'data', 'dataText', 'dataStatistical'));
    }

    private function getTextChart($type, $time1 = null, $time2 = null) {
        switch ($type) {
            case 1:
                $dataText = [
                    'description' => 'Thông kê doanh số của các ngày trong tháng',
                    'title' => 'Doanh thu các ngày trong tháng',
                    'x_title' => 'Ngày',
                    'y_title' => 'Doanh số (VND)'
                ];
                break;
            case 2:
                $dataText = [
                    'description' => 'Thông kê doanh số của các tháng trong năm',
                    'title' => 'Doanh thu các ngày các tháng trong năm',
                    'x_title' => 'Tháng',
                    'y_title' => 'Doanh số (VND)'
                ];
                break;
            case 3:
                $dataText = [
                    'description' => 'Thông kê doanh số các năm',
                    'title' => 'Doanh thu các Năm',
                    'x_title' => 'Năm',
                    'y_title' => 'Doanh số (VND)'
                ];
                break;
            case 4:
                $dataText = [
                    'description' => $time1 == $time2 ? 'Thông kê doanh số ngày '.$time1 : 'Thông kê doanh số từ ngày '.$time1.' đến ngày '.$time2,
                    'title' => $time1 == $time2 ? 'Doanh thu ngày '.$time1 : 'Doanh thu từ ngày '.$time1.' đến ngày '.$time2,
                    'x_title' => 'Ngày',
                    'y_title' => 'Doanh số (VND)'
                ];
                break;
            case 5:
                $dataText = [
                    'description' => 'Thống kê trạng thái đơn hàng của các ngày trong tháng',
                    'title' => 'Thống kê trạng thái đơn hàng của các ngày trong tháng',
                ];
                break;
            case 6:
                $dataText = [
                    'description' => $time1 == $time2 ? 'Thống kê trạng thái đơn hàng ngày '.$time1 : 'Thống kê trạng thái đơn hàng từ ngày '.$time1.' đến ngày '.$time2,
                    'title' => $time1 == $time2 ? 'Thống kê trạng thái đơn hàng ngày '.$time1 : 'Thống kê trạng thái đơn hàng ngày ngày '.$time1.' đến ngày '.$time2,
                ];
                break;
            case 7:
                $dataText = [
                    'description' => 'Thống kê trạng thái đơn hàng của các tháng trong năm',
                    'title' => 'Thống kê trạng thái đơn hàng của các tháng trong năm'
                ];
                break;
            case 8:
                $dataText = [
                    'description' => 'Thống kê trạng thái đơn hàng năm',
                    'title' => 'Thống kê trạng thái đơn hàng các Năm',
                ];
                break;

        }

        return $dataText;
    }
}
