<?php

use \Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;

class CreateReadNotificationAtTable extends Migration
{
    public function up()
    {
        Schema::create('read_notification_at', function (Blueprint $table) {
            $table->bigInteger('reader')->unsigned();
            $table->foreign('reader')->references('id')->on('users');
            $table->timestamp('read_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('read_notification_at');
    }
}
