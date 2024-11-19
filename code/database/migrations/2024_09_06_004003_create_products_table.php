<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                // Cột tên sản phẩm
            $table->text('description');           // Cột mô tả sản phẩm
            $table->integer('quantity');           // Cột số lượng sản phẩm
            $table->decimal('price', 10,2);     // Cột giá sản phẩm (10 số, 2 số sau dấu thập phân)
            $table->string('image')->nullable();  // Cột hình ảnh sản phẩm (nullable nếu không bắt buộc) 
            $table->foreignId('category_id')       // Khóa ngoại liên kết đến bảng categories
                  ->constrained()
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        
    }

    
};
