<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('parent_id')->default(null)->nullable();
            $table->string('slug')->default(null)->nullable();
            $table->string('title')->default(null)->nullable();
            $table->longtext('content')->default(null)->nullable();
            $table->string('main_image')->default(null)->nullable();
            $table->string('main_video')->default(null)->nullable();
            $table->text('seo')->default(null)->nullable();
            $table->longtext('seo_description')->default(null)->nullable();
            $table->integer('sort_order')->default(0)->nullable();
            $table->string('status')->default('1')->comment('1=>Active,0=>Inactive')->nullable();
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
        Schema::drop('pages');
    }
}
