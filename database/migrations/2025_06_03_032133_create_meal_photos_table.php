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
        Schema::create('meal_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meal_id'); // Make sure this line exists
            $table->string('image_path');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
        });
    }


    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_photos');
    }
};
