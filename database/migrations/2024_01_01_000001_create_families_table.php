<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('parent_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('suburb');
            $table->string('postcode', 10);
            $table->string('state')->default('QLD');
            $table->integer('children_count');
            $table->json('children_ages')->nullable();
            $table->string('care_type');
            $table->json('days_required')->nullable();
            $table->date('preferred_start_date')->nullable();
            $table->string('cultural_preferences')->nullable();
            $table->string('wait_time')->nullable();
            $table->boolean('privacy_consent')->default(false);
            $table->enum('status', ['pending', 'matched', 'waitlisted'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
