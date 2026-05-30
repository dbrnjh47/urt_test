<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_points', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('point_id');
            $table->integer("count")->unsigned();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade'); // ->onDelete('cascade')
            $table->foreign('point_id')->references('id')->on('points')->onUpdate('cascade')->onDelete('cascade'); // ->onDelete('cascade')

            $table->unique(['point_id', 'product_id'], 'product_point_unique');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_points');
    }
};
