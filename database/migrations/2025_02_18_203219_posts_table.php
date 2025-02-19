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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();  
            $table->string('small_header'); 
            $table->string('small_header_ar');  
            $table->string('name');  
            $table->string('name_ar');
            $table->text('description'); 
            $table->text('description_ar');
            $table->string('button_name');  
            $table->string('button_name_ar');
            $table->text('button_link');  
            $table->string('image_path');  
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
