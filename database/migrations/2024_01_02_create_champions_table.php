<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('champions', function (Blueprint $table) {
            $table->id();
            $table->string('league_code');
            $table->string('season_year');
            $table->string('team_name');
            $table->string('team_crest');
            $table->timestamps();

            // İndexler
            $table->index('league_code');
            $table->index('season_year');
            $table->unique(['league_code', 'season_year']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('champions');
    }
}; 