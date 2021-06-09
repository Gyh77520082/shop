<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->BigIncrements('id')->comment('ID');
            $table->string('title')->comment('商品名称');
            $table->text('description')->comment('商品详情');
            $table->string('images')->comment('商品封面图片路径');
            $table->boolean('on_sale')->default(true)->comment('售卖状态 1:在售 0:停售');
            $table->float('rating')->default(5)->comment('平均评分');
            $table->unsignedInteger('sold_count')->comment('数量')->default(0);
            $table->unsignedInteger('review_count')->comment('评价数')->default(0);
            $table->decimal('price', 10, 2)->coment('sku最低价格');
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
        Schema::dropIfExists('products');
    }
}
