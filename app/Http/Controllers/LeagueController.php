<?php

namespace App\Http\Controllers;

use App\Services\FootballApiService;
use App\Models\Standing;
use Illuminate\Support\Facades\Log;
use App\Models\Odds;

class LeagueController extends Controller
{
    protected $footballApi;

    public function __construct(FootballApiService $footballApi)
    {
        $this->footballApi = $footballApi;
    }

    private function saveMatchOdds($matches)
    {
        foreach ($matches['matches'] as $match) {
            if ($match['status'] === 'SCHEDULED' || $match['status'] === 'TIMED') {
                $this->footballApi->saveOdds(
                    $match['id'],
                    number_format(rand(150, 300) / 100, 2),
                    number_format(rand(250, 400) / 100, 2),
                    number_format(rand(150, 300) / 100, 2),
                    $match['utcDate']
                );
            }
        }
    }

    public function show($code)
    {
        try {
            $league = $this->footballApi->get("/competitions/{$code}");
            $matches = $this->footballApi->get("/competitions/{$code}/matches");
            
            // Puan durumunu veritabanından çek
            $standings = Standing::where('league_code', $code)
                ->orderBy('position')
                ->get()
                ->map(function($standing) {
                    return [
                        'position' => $standing->position,
                        'team' => [
                            'id' => $standing->team_id,
                            'name' => $standing->team_name,
                            'shortName' => $standing->team_name,
                            'crest' => $standing->team_crest
                        ],
                        'playedGames' => $standing->played_games,
                        'won' => $standing->won,
                        'draw' => $standing->draw,
                        'lost' => $standing->lost,
                        'goalsFor' => $standing->goals_for,
                        'goalsAgainst' => $standing->goals_against,
                        'goalDifference' => $standing->goal_difference,
                        'points' => $standing->points,
                        'form' => $standing->form
                    ];
                });

            // Standings verisini düzenle
            $standings = [
                'standings' => [
                    [
                        'table' => $standings
                    ]
                ]
            ];
            
            // Arşiv verilerini veritabanından çek
            $champions = \App\Models\Champion::where('league_code', $code)
                ->orderByDesc('season_year')
                ->get()
                ->map(function($champion) {
                    return [
                        'startDate' => $champion->season_year . '-01-01',
                        'endDate' => $champion->season_year . '-12-31',
                        'winner' => [
                            'name' => $champion->team_name,
                            'crest' => $champion->team_crest
                        ]
                    ];
                });

            // League verisine arşiv bilgilerini ekle
            $league['seasons'] = $champions;
            
            // Oranları kaydet
            $this->saveMatchOdds($matches);
            
            // Oranları çek
            $matchOdds = Odds::whereIn('match_id', collect($matches['matches'])->pluck('id'))
                ->get()
                ->keyBy('match_id');

            // Mevcut haftayı al
            $currentMatchday = collect($matches['matches'])
                ->where('status', 'SCHEDULED')
                ->pluck('matchday')
                ->first() ?? 1;

            // Son maçları grupla
            $recentMatches = collect($matches['matches'])
                ->where('matchday', $currentMatchday)
                ->groupBy('matchday');

            // View'a gönder
            return view('leagues.show', [
                'league' => $league,
                'matches' => $matches,
                'recentMatches' => $recentMatches,
                'standings' => $standings,
                'currentMatchday' => $currentMatchday,
                'matchOdds' => $matchOdds
            ]);

        } catch (\Exception $e) {
            Log::error('League show error:', [
                'error' => $e->getMessage(),
                'code' => $code
            ]);
            return back()->with('error', 'Lig bilgileri alınamadı: ' . $e->getMessage());
        }
    }
} 