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
        Schema::create('sailing_schedules', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Export', 'Import']);
            $table->enum('service', ['LCL', 'FCL']);

            // Relasi ke tabel ports
            $table->foreignId('pol_id')->constrained('ports')->onDelete('cascade');
            $table->foreignId('pod_id')->constrained('ports')->onDelete('cascade');

            $table->string('vessel');
            $table->string('voyage');

            // Jadwal
            $table->date('etd');
            $table->date('eta_destination');
            $table->date('eta_destination1')->nullable();
            $table->date('eta_destination2')->nullable();
            $table->date('eta_destination3')->nullable();
            $table->date('eta_destination4')->nullable();
            $table->date('eta_destination5')->nullable();
            $table->date('eta_destination6')->nullable();
            $table->date('eta_destination7')->nullable();
            $table->text('eta_text')->nullable();

            $table->string('connecting_vessel')->nullable();
            $table->string('connecting_voyage')->nullable();
            $table->date('connecting_etd')->nullable();
            $table->date('connecting_eta')->nullable();
            // $table->string('code_connecting')->nullable();

            $table->text('remarks_field')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sailing_schedules');
    }
};
