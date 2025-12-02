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
    Schema::create('performances', function (Blueprint $table) {
        $table->id();
        $table->string('title');                 
        $table->date('date');                    
        $table->decimal('ticket_price', 8, 2);   
        $table->string('image_path')->nullable(); 
        
        $table->foreignId('venue_id')->constrained()->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
