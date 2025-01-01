<?php

namespace App\Http\Controllers;

use App\Services\FootballApiService;
use App\Models\Standing;
use Illuminate\Support\Facades\Log;

class LeagueController extends Controller
{
    protected $footballApi;

    public function __construct(FootballApiService $footballApi)
    {
        $this->footballApi = $footballApi;
    }

    public function show($code)
    {
        try {
            // Lig bilgilerini çek
            $league = $this->footballApi->get("/competitions/{$code}");
            if (!$league) {
                throw new \Exception('Lig bilgileri alınamadı');
            }

            // Sezonları filtrele ve sırala (2000'den sonrası)
            if (isset($league['seasons'])) {
                $league['seasons'] = collect($league['seasons'])
                    ->filter(function($season) {
                        return (int)substr($season['startDate'], 0, 4) >= 2000;
                    })
                    ->map(function($season) use ($code) {
                        if (!isset($season['winner'])) {
                            $startYear = substr($season['startDate'], 0, 4);
                            
                            // Veritabanından şampiyonu çek
                            $champion = \App\Models\Champion::where('league_code', $code)
                                ->where('season_year', $startYear)
                                ->first();

                            if ($champion) {
                                $season['winner'] = [
                                    'name' => $champion->team_name,
                                    'crest' => $champion->team_crest
                                ];
                            }
                        }
                        return $season;
                    })
                    ->sortByDesc('startDate')
                    ->values()
                    ->all();
            }

            // Maçları çek
            $matches = $this->footballApi->get("/competitions/{$code}/matches");
            
            // Basit sabit oranlar ekle (test için)
            $matches['matches'] = collect($matches['matches'])->map(function($match) {
                if ($match['status'] === 'SCHEDULED') {
                    $match['odds'] = [
                        '1' => number_format(rand(150, 350) / 100, 2),
                        'X' => number_format(rand(200, 400) / 100, 2),
                        '2' => number_format(rand(150, 350) / 100, 2)
                    ];
                }
                return $match;
            })->all();

            // Mevcut haftayı al
            $currentMatchday = $league['currentSeason']['currentMatchday'] ?? 1;

            // Son 2 haftanın maçlarını filtrele
            $recentMatches = collect($matches['matches'] ?? [])
                ->filter(function($match) use ($currentMatchday) {
                    return $match['matchday'] >= ($currentMatchday - 2) && 
                           $match['matchday'] <= $currentMatchday;
                })
                ->groupBy('matchday')
                ->sortByDesc('matchday');

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

            // View'a gönder
            return view('leagues.show', [
                'league' => $league,
                'matches' => $matches,
                'recentMatches' => $recentMatches,
                'standings' => ['standings' => [['table' => $standings]]],
                'currentMatchday' => $currentMatchday
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