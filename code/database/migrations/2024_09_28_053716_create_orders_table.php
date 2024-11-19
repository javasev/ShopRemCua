<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Tham chiếu đến bảng users
            $table->decimal('total', 10, 2); // Tổng giá trị đơn hàng
            $table->enum('status', ['processing', 'paid', 'cancelled'])->default('processing'); // Trạng thái đơn hàng
            $table->enum('payment_method', ['COD', 'online'])->default('COD'); // Phương thức thanh toán
            $table->timestamps(); // Các trường created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

