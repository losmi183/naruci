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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('category_blueprint_id')->nullable();
            $table->foreign('category_blueprint_id')->references('id')->on('category_blueprints')->onUpdate('cascade')->onDelete('cascade');

            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('price')->nullable();

            $table->integer('centimeters')->nullable();
            $table->integer('grams')->nullable();

            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
