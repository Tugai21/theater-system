<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('performances', function (Blueprint $table) {
            if (Schema::hasColumn('performances', 'ticket_price')) {
                $table->dropColumn('ticket_price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->decimal('ticket_price', 8, 2)->default(0);
        });
    }
};
