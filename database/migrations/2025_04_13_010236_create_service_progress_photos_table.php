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
        Schema::create('service_progress_photos', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference_number');
            $table->foreign('reference_number')->references('reference_number')->on('service_requests')->onDelete('cascade');
            $table->string('before_photo')->nullable();
            $table->string('after_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_progress_photos');
    }
};
