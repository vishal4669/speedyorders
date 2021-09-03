<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempProductOptionValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_product_option_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('php_session_id', 255)->default(null)->nullable();
            $table->integer('product_id')->default(null)->nullable();
            $table->string('option_id')->default(null)->nullable();
            $table->string('option_value')->default(null)->nullable();
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
        Schema::dropIfExists('temp_product_option_value');
    }
}
