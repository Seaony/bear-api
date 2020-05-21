<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEggsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eggs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('female_avatar')->index()->comment('母猫头像');
            $table->string('male_name')->index()->comment('公猫名称');
            $table->string('female_name')->index()->comment('母猫名称');
            $table->date('cracked_at')->index()->comment('破壳时间');
            $table->date('breeding_at')->index()->comment('配种时间');
            $table->unsignedBigInteger('user_id')->index()->comment('用户 ID');
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
        Schema::dropIfExists('eggs');
    }
}
