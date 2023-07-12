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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->longText('first_description');
            $table->string('first_point');
            $table->string('second_point');
            $table->string('third_point');
            $table->longText('last_description');
            $table->string('slug');
            $table->string('about_us_image');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('contact_us_number');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};