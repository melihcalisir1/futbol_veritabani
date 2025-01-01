<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    protected $fillable = [
        'league_code',
        'season_year',
        'team_name',
        'team_crest'
    ];
} 