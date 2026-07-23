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
        Schema::table('sailing_schedules', function (Blueprint $table) {
            $table->date('eta_klf')->nullable()->after('etd_code_connecting');
            $table->string('connecting_klf')->nullable()->after('eta_klf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sailing_schedules', function (Blueprint $table) {
            $table->dropColumn(['eta_klf', 'connecting_klf']);
        });
    }
};
