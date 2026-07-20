<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('combo_product', function (Blueprint $table) {
            // Allow a combo row to exist without a real product
            $table->foreignId('product_id')->nullable()->change();

            // Manual entry fields, used when product_id is null
            $table->string('custom_name')->nullable()->after('product_id');
            $table->string('custom_name_ta')->nullable()->after('custom_name');
        });
    }

    public function down(): void
    {
        Schema::table('combo_product', function (Blueprint $table) {
            $table->dropColumn(['custom_name', 'custom_name_ta']);
            $table->foreignId('product_id')->nullable(false)->change();
        });
    }
};
