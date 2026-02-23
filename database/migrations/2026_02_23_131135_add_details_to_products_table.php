<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('stock')->default(0)->after('price');
            $table->string('category')->nullable()->after('stock');
            $table->string('status')->default('active')->after('category');
            $table->json('images')->nullable()->after('image');
            $table->json('sizes')->nullable()->after('images');
            $table->json('colors')->nullable()->after('sizes');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['stock', 'category', 'status', 'images', 'sizes', 'colors']);
        });
    }
};