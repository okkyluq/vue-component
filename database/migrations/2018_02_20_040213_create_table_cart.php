<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_cookie');
            $table->integer('product_id')->unsigned();
            $table->string('product_name');
            $table->decimal('price', 8,0);
            $table->integer('qty');
            $table->decimal('total');
            $table->timestamps();
        });

        Schema::table('cart', function (Blueprint $table){
            $table->foreign('product_id')
                    ->references('id')
                    ->on('product')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
