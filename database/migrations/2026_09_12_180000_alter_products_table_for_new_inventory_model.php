<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable()->change();
            $table->string('unit')->default('Cái')->change();
            $table->decimal('purchase_price', 12, 2)->default(0)->change();
            $table->decimal('selling_price', 12, 2)->default(0)->change();
            $table->integer('quantity')->default(0)->change();
            $table->integer('reorder_level')->default(0)->change();
            $table->enum('status', ['active', 'inactive'])->default('active')->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable(false)->change();
            $table->string('unit')->change();
            $table->decimal('purchase_price', 12, 2)->default(0)->change();
            $table->decimal('selling_price', 12, 2)->default(0)->change();
            $table->integer('quantity')->default(0)->change();
            $table->integer('reorder_level')->default(0)->change();
            $table->enum('status', ['active', 'inactive'])->default('active')->change();
        });
    }
};
