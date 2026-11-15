<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_settings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('professional_title');
            $table->text('short_bio');
            $table->longText('biography')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->string('cv_file')->nullable();
            $table->string('site_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('accent_color')->default('#22c55e');
            $table->string('hero_intro')->default("HI I'M A FREELANCER");
            $table->string('hero_heading')->default('Web Developer');
            $table->text('hero_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_settings');
    }
};
