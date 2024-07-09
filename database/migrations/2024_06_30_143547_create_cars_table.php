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
            $table->string('type');
            $table->string('body_color');
            $table->string('body_type');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->decimal('price');
            $table->string('number');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->integer('seating_capacity');
            $table->string('fuel_type');
            $table->string('displacement');
            $table->string('max_power');
            $table->string('max_torque');
            $table->string('mileage');
            $table->string('transmission');
            $table->integer('no_of_gears');
            $table->enum('air_conditioning',['true','false']);
            $table->enum('power_windows',['true','false']);
            $table->enum('central_locking',['true','false']);
            $table->enum('abs',['true','false']);
            $table->enum('air_bags',['true','false']);
            $table->string('front_tire');
            $table->string('rear_tire');
            $table->text('description');
            $table->integer('fuel_capacity');
            $table->integer('boot_space');
            $table->enum('fog_lamps',['true','false']);
            $table->string('engine_display');
            $table->year('make_year');
            $table->year('registration_year');
            $table->integer('no_of_owners');
            $table->string('insurance_type');
            $table->string('rto');
            $table->integer('km_driven');
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
