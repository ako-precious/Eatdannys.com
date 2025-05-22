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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->timestamps();
        });

        Schema::create('meals', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key to categories table
            $table->string('name'); // Name of the meal 
            $table->text('description')->nullable(); // Description of the meal
            $table->json('prices');       // Price of the meal in JSON format
            $table->timestamps(); // created_at and updated_at columns

            // Foreign key constraint (optional, but recommended)
             $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('SET NULL'); // or 'CASCADE', depending on your needs
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        
        Schema::dropIfExists('meals');
    }
};
