<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistical', function (Blueprint $table) {
            $table->id();
            $table->string('day', 50)->comment('Ngày thống kê');
            $table->string('revenue', 50)->comment('Doanh thu trong một ngày');
            $table->string('best_selling_product', 50)->comment('Sản phẩm bán chạy nhất trong một ngày');
            $table->string('best_selling_color', 15)->comment('Màu bán chạy nhất trong một ngày');
            $table->string('best_selling_size', 10)->comment('Size bán chạy nhất trong một ngày');
            $table->integer('delivering_order')->comment('Đơn đang giao trong một ngày');
            $table->integer('success_order')->comment('Đơn thành công trong một ngày');
            $table->integer('cancel_order')->comment('Đơn hủy trong một ngày');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistical');
    }
};
