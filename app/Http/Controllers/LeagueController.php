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

            // Puan durumunu çek ve form bilgisini ekle
            $standings = Standing::where('league_code', $code)
                ->orderBy('position')
                ->get()
                ->map(function($standing) use ($matches) {
                    // Son 5 maçı al
                    $lastMatches = collect($matches['matches'])
                        ->filter(function($match) use ($standing) {
                            return ($match['homeTeam']['id'] == $standing->team_id || 
                                    $match['awayTeam']['id'] == $standing->team_id) &&
                                   $match['status'] === 'FINISHED';
                        })
                        ->sortByDesc('utcDate')
                        ->take(5);

                    // Form hesapla
                    $form = '';
                    foreach ($lastMatches as $match) {
                        $isHome = $match['homeTeam']['id'] == $standing->team_id;
                        $teamScore = $isHome ? $match['score']['fullTime']['home'] : $match['score']['fullTime']['away'];
                        $opponentScore = $isHome ? $match['score']['fullTime']['away'] : $match['score']['fullTime']['home'];

                        if ($teamScore > $opponentScore) {
                            $form = 'W' . $form;
                        } elseif ($teamScore < $opponentScore) {
                            $form = 'L' . $form;
                        } else {
                            $form = 'D' . $form;
                        }
                    }

                    $standing->form = $form;
                    return $standing;
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