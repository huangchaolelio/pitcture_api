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
        Schema::create('banner', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('first_title', 32)->nullable();
            $table->string('second_title', 32)->nullable();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_show')->nullable()->default(false)->comment('0为下架，1为上架');
            $table->integer('orders')->nullable()->default(0);
            $table->integer('created_time')->nullable();
            $table->integer('updated_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner');
    }
};
