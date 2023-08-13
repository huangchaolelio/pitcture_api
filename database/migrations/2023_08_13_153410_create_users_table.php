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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('openid')->nullable();
            $table->string('nickname', 32)->nullable();
            $table->string('mobile', 32)->nullable();
            $table->string('email', 32)->nullable();
            $table->string('avatar_url', 500)->nullable();
            $table->boolean('gender')->nullable();
            $table->tinyInteger('age')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('score')->nullable()->default(0);
            $table->string('name', 32)->nullable();
            $table->string('remark', 500)->nullable();
            $table->boolean('disable')->nullable()->default(true)->comment('0为屏蔽，1为正常');
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
        Schema::dropIfExists('users');
    }
};
