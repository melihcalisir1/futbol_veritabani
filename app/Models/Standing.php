<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    protected $fillable = [
        'league_code',
        'position',
        'team_id',
        'team_name',
        'team_crest',
        'played_games',
        'won',
        'draw',
        'lost',
        'goals_for',
        'goals_against',
        'goal_difference',
        'points',
        'form'
    ];
} 