<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educators', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('suburb');
            $table->string('postcode', 10);
            $table->string('state')->default('QLD');
            $table->string('qualification');
            $table->string('blue_card_number')->nullable();
            $table->date('blue_card_expiry')->nullable();
            $table->enum('insurance_status', ['valid', 'pending', 'none'])->default('pending');
            $table->json('care_types')->nullable();
            $table->json('availability')->nullable();
            $table->integer('max_children')->default(4);
            $table->string('age_groups')->nullable();
            $table->json('training_needs')->nullable();
            $table->text('service_description')->nullable();
            $table->boolean('privacy_consent')->default(false);
            $table->enum('status', ['pending', 'verified', 'active', 'suspended'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educators');
    }
};
