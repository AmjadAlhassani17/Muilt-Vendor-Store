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
        Schema::create('stores', function (Blueprint $table) {
            // id bigInt unsigned auto_increment primary_key
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('discrption')->nullable();
            $table->string('logo-image')->nullable();
            $table->string('cover-image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            // created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};