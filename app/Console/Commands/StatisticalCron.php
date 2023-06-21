<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StatisticalCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistical:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add data to statistics after 10 minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $statistical = DB::table('statistical')->where('day', now()->format('Y-m-d'))->first();

        if (empty($statistical)) {
            DB::table('statistical')->insert( $this->dataCron());
            DB::table('statistical')->where('day', now()->subDay()->format('Y-m-d'))->update(['delivering_order' => 0]);
        } else {
            $dataStatistical = DB::table('statistical')->where('day', now()->format('Y-m-d'))->first();
            $data = $this->dataCron();

            $data['revenue'] = $data['revenue'] + $dataStatistical->revenue;
            $data['success_order'] = $data['success_order'] + $dataStatistical->success_order;
            $data['cancel_order'] = $data['cancel_order'] + $dataStatistical->cancel_order;

            DB::table('statistical')->update($data);
        }
        DB::table('orders')->update(['calculator' => 1]);

        $this->info('statistical:cron Cummand Run successfully!');
    }

    public function dataCron() {
        $data = $this->order();
        $data['day'] = now()->format('Y-m-d');
        $data['revenue'] = $this->sumTotal();
        $data['delivering_order'] = $this->deliveringOrder();
        $data['success_order'] = $this->successOrder();
        $data['cancel_order'] = $this->cancelOrder();
        $data['created_at'] = now()->toDateTimeString();
        $data['updated_at'] = now()->toDateTimeString();

        return $data;
    }

    public function sumTotal() {
        $revenue = Order::where('calculator', 0)
            ->where('status', 3)
            ->select(DB::raw('SUM(total) AS total_amount'))
            ->first();

        return $revenue->total_amount;
    }

    public function deliveringOrder() {
        $delivering_order = Order::where('calculator', 0)
            ->where('status', 2)
            ->select(DB::raw('COUNT(*) AS count_delivering_order'))
            ->first();

        return $delivering_order->count_delivering_order;
    }

    public function successOrder() {
        $success_order = Order::where('calculator', 0)
            ->where('status', 3)
            ->select(DB::raw('COUNT(*) AS count_success_order'))
            ->first();

        return $success_order->count_success_order;
    }

    public function cancelOrder() {
        $cancel_order = Order::where('calculator', 0)
            ->where('status', 4)
            ->select(DB::raw('COUNT(*) AS count_cancel_order'))
            ->first();

        return $cancel_order->count_cancel_order;
    }

    public function order(){
        $order = Order::where('calculator', 0)->where('status', 3)
            ->leftJoin('order_details', function ($join) {
                $join->on('orders.order_id', '=', 'order_details.order_id');
            })
            ->join('product_details', 'order_details.product_detail_id', '=', 'product_details.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'products.name',
                'product_details.color',
                'product_details.size',
                'order_details.product_id',
                'order_details.product_detail_id', DB::raw('SUM(order_details.quantity) as total_quantity')
            )
            ->groupBy('products.name')
            ->groupBy('order_details.product_detail_id')
            ->groupBy('product_details.color')
            ->groupBy('product_details.size')
            ->groupBy('order_details.product_id')
            ->orderBy('total_quantity', 'DESC')
            ->first();
        return [
            'best_selling_product' => $order->name,
            'best_selling_color' => $order->color,
            'best_selling_size' => $order->size
        ];
    }

}
