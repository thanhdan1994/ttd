<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('model');
            $table->bigInteger('creator')->unsigned();
            $table->foreign('creator')->references('id')->on('users');
            $table->bigInteger('receiver')->unsigned();
            $table->foreign('receiver')->references('id')->on('users');
            $table->integer('message_type_id')->unsigned();
            $table->foreign('message_type_id')->references('message_type')->on('message_type');
            $table->string('link')->nullable();
            $table->boolean('status')->default(false); // 0 chưa đọc, 1 đã đọc
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
        Schema::dropIfExists('notifications');
    }
}
