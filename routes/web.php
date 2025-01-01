<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\TeamController;

Route::get('/', [MatchController::class, 'index']);
Route::get('/matches', [MatchController::class, 'index'])->name('matches.all');
Route::get('/matches/odds', [MatchController::class, 'odds'])->name('matches.odds');
Route::get('/matches/finished', [MatchController::class, 'finished'])->name('matches.finished');
Route::get('/matches/scheduled', [MatchController::class, 'scheduled'])->name('matches.scheduled');

Route::get('/league/{code}', [LeagueController::class, 'show'])->name('league.show');

Route::get('/team/{teamId}', [TeamController::class, 'show'])->name('team.show');
