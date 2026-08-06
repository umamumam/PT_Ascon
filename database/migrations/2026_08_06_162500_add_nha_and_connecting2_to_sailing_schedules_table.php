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
            $table->date('eta_nha')->nullable()->after('etd_code_connecting');
            $table->string('connecting2_vessel')->nullable()->after('eta_nha');
            $table->string('connecting2_voyage')->nullable()->after('connecting2_vessel');
            $table->date('connecting2_etd')->nullable()->after('connecting2_voyage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sailing_schedules', function (Blueprint $table) {
            $table->dropColumn([
                'eta_nha',
                'connecting2_vessel',
                'connecting2_voyage',
                'connecting2_etd'
            ]);
        });
    }
};
