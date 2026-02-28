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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Export', 'Import']);
            $table->string('bl_number')->unique();
            $table->string('shipper');
            $table->string('consignee');
            $table->string('origin');
            $table->string('destination');
            $table->enum('shipment_type', ['LCL', 'FCL']);

            $table->string('total_measurement')->nullable();
            $table->string('total_packages')->nullable();

            $table->string('container_number')->nullable();
            $table->string('size_type')->nullable();

            $table->string('vessel_voyage');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
