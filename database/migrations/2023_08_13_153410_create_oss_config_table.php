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
        Schema::create('oss_config', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->string('mark', 50)->nullable();
            $table->integer('tag')->nullable();
            $table->string('bucket')->nullable();
            $table->string('domain')->nullable();
            $table->string('accesskey')->nullable();
            $table->string('secretkey')->nullable();
            $table->boolean('status')->nullable()->default(false)->comment('0为未启用，1为启用');
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
        Schema::dropIfExists('oss_config');
    }
};
