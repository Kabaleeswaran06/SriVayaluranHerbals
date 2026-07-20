<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('combos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_ta')->nullable();
            $table->string('slug')->unique();
            $table->string('banner_image')->nullable(); // 1248x502
            $table->string('main_image')->nullable();
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->text('additional_info')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('combos');
    }
};