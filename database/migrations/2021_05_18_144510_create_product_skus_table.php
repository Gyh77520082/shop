<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_skus', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->string('title')->comment('sku名称');
            $table->string('description')->comment('sku描述');
            $table->decimal('price',10,2)->commnet('价格');
            $table->unsignedInteger('stock')->commnet('库存');
            $table->unsignedBigInteger('product_id')->comment('商品关联ID');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('product_skus');
    }
}
