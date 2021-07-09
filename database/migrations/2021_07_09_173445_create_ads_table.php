<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('标题');
            $table->dateTime('start_time')->comment('开始时间');
            $table->dateTime('end_time')->comment('结束时间');
            $table->unsignedTinyInteger('display_times')->default(1)->comment('展示总次数');
            $table->unsignedTinyInteger('display_interval')->default(1)->comment('展示间隔:天');
            $table->unsignedTinyInteger('status')->default(\App\Models\Ad::STATUS_ONLINE)->comment('展示间隔:天');
            $table->string('image')->nullable()->comment('展示图片');
            $table->string('url')->nullable()->comment('跳转地址');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
