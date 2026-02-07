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
        Schema::create('tracking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tracking_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['departed', 'discharge', 'connecting', 'arrival'])->nullable();
            $table->string('place_of_activity')->nullable();
            $table->date('date')->nullable();
            $table->string('vessel_information')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('sequence', ['1st', '2nd', '3rd'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_details');
    }
};
