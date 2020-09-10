<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('goods_id')->nullable($value = false)->comment('商品id');
            $table->string('goods_name')->nullable($value = false)->comment('商品名称');
            $table->string('goods_price')->nullable($value = false)->comment('商品价格');
              $table->string('goods_num')->nullable($value = false)->comment('商品存库');
                $table->string('goods_image')->comment('商品图片');
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
        Schema::dropIfExists('goods');
    }
}
