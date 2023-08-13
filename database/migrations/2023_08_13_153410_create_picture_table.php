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
        Schema::create('picture', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('describe', 500)->nullable();
            $table->integer('pic_category_id')->nullable();
            $table->boolean('device_type')->nullable();
            $table->integer('item_count')->nullable()->default(0)->comment('图辑中图片的数量');
            $table->integer('score')->nullable()->default(0)->comment('下载所需积分');
            $table->integer('download')->nullable()->default(0)->comment('下载次数');
            $table->integer('collect')->nullable()->default(0)->comment('收藏次数');
            $table->integer('like')->nullable()->default(0)->comment('点赞次数');
            $table->integer('visit')->nullable()->default(0)->comment('浏览次数');
            $table->boolean('is_show')->nullable()->default(false)->comment('0为不显示，1为显示');
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
        Schema::dropIfExists('picture');
    }
};
