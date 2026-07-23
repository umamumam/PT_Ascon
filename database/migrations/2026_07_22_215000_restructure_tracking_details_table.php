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
        Schema::table('tracking_details', function (Blueprint $table) {
            // Drop status column if it exists
            if (Schema::hasColumn('tracking_details', 'status')) {
                $table->dropColumn('status');
            }
            
            // Rename date to date_of_departure if date column exists
            if (Schema::hasColumn('tracking_details', 'date')) {
                $table->renameColumn('date', 'date_of_departure');
            } elseif (!Schema::hasColumn('tracking_details', 'date_of_departure')) {
                $table->date('date_of_departure')->nullable()->after('place_of_activity');
            }

            // Add port_of_arrival if not exists
            if (!Schema::hasColumn('tracking_details', 'port_of_arrival')) {
                $table->string('port_of_arrival')->nullable()->after('date_of_departure');
            }

            // Add date_of_arrival if not exists
            if (!Schema::hasColumn('tracking_details', 'date_of_arrival')) {
                $table->date('date_of_arrival')->nullable()->after('port_of_arrival');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracking_details', function (Blueprint $table) {
            if (!Schema::hasColumn('tracking_details', 'status')) {
                $table->string('status')->nullable()->after('vessel_information');
            }
            if (Schema::hasColumn('tracking_details', 'date_of_departure')) {
                $table->renameColumn('date_of_departure', 'date');
            }
            if (Schema::hasColumn('tracking_details', 'port_of_arrival')) {
                $table->dropColumn('port_of_arrival');
            }
            if (Schema::hasColumn('tracking_details', 'date_of_arrival')) {
                $table->dropColumn('date_of_arrival');
            }
        });
    }
};
