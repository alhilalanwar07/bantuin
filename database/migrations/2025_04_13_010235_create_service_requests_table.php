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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference_number')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('provider_id')->constrained('service_providers')->onDelete('cascade')->nullable();
            $table->foreignId('specialization_id')->constrained()->onDelete('cascade');
            $table->text('service_address');
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->dateTime('scheduled_at');
            $table->bigInteger('budget_amount');
            $table->bigInteger('agreed_amount')->nullable();
            $table->foreignId('status_id')->constrained('service_statuses')->onDelete('cascade');
            $table->text('description');
            $table->text('cancellation_reason')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
