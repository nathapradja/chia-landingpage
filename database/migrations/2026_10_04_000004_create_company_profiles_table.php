<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Chia by Amidyas Superfood');
            $table->string('tagline')->default('Kebaikan Alam untuk Hidup Lebih Sehat & Berenergi');
            $table->text('short_description')->nullable();
            $table->longText('about_us')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->json('values')->nullable(); // Key company values/advantages
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
