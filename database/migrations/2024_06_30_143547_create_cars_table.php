<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('image4');
            $table->string('image5');
            $table->string('type');
            $table->string('body_color');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->integer('price');
            $table->string('number');
            $table->string('fuel_type');
            $table->string('mileage');
            $table->string('transmission');
            $table->integer('no_of_owners');
            $table->longText('description');
            $table->string('max_power');
            $table->string('position');
            $table->unsignedInteger('view')->default(0);
            $table->enum('status',['0','1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};





