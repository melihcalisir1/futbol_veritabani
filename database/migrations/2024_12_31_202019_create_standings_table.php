<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->string('league_code'); // PL, BL1, etc.
            $table->integer('position');
            $table->string('team_id');
            $table->string('team_name');
            $table->string('team_crest');
            $table->integer('played_games');
            $table->integer('won');
            $table->integer('draw');
            $table->integer('lost');
            $table->integer('goals_for');
            $table->integer('goals_against');
            $table->integer('goal_difference');
            $table->integer('points');
            $table->string('form')->nullable();
            $table->timestamps();

            // Composite index
            $table->unique(['league_code', 'team_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('standings');
    }
};