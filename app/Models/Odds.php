<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Odds extends Model
{
    protected $fillable = [
        'match_id',
        'home_win_odds',
        'draw_odds',
        'away_win_odds',
        'match_date'
    ];

    protected $casts = [
        'match_date' => 'datetime',
        'home_win_odds' => 'decimal:2',
        'draw_odds' => 'decimal:2',
        'away_win_odds' => 'decimal:2'
    ];
}
