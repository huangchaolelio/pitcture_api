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
        Schema::create('picture_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('picture_id')->nullable();
            $table->string('url')->nullable();
            $table->integer('download')->nullable()->default(0);
            $table->integer('collect')->nullable()->default(0);
            $table->boolean('is_show')->nullable()->default(false)->comment('0为不显示，1为显示');
            $table->integer('oss_tag')->nullable();
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
        Schema::dropIfExists('picture_item');
    }
};
