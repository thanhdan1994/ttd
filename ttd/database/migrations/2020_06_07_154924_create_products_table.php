<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('name');
            $table->string('slug');
            $table->text('excerpt');
            $table->string('phone');
            $table->decimal('amount', 9, 2)->default(0);
            $table->string('address');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->longText('content')->nullable();
            $table->bigInteger('featured_image')->default(0);
            $table->json('properties')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('products');
    }
}
