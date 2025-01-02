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
        Schema::create('odds', function (Blueprint $table) {
            $table->id();
            $table->string('match_id');
            $table->decimal('home_win_odds', 8, 2);
            $table->decimal('draw_odds', 8, 2);
            $table->decimal('away_win_odds', 8, 2);
            $table->dateTime('match_date');
            $table->timestamps();

            $table->unique('match_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odds');
    }
};
