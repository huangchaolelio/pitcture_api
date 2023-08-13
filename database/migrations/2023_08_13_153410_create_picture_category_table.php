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
        Schema::create('picture_category', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 60)->nullable();
            $table->boolean('is_show')->nullable()->default(false);
            $table->integer('orders')->nullable();
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
        Schema::dropIfExists('picture_category');
    }
};
