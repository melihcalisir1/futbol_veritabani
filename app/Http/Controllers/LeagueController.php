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
            // Önce API yanıtını kontrol edelim
            $apiStandings = $this->footballApi->get("/competitions/{$code}/standings");
            
            // API yanıtını detaylı logla
            Log::info('API Response Debug:', [
                'code' => $code,
                'raw_response' => $apiStandings
            ]);

            // Eğer API yanıtı boşsa veya hatalıysa, veritabanından çek
            if (!$apiStandings) {
                $standings = Standing::where('league_code', $code)
                    ->orderBy('position')
                    ->get();

                if ($standings->isEmpty()) {
                    throw new \Exception('Puan durumu bulunamadı');
                }

                return view('leagues.show', [
                    'standings' => ['standings' => [['table' => $standings]]],
                    'error' => 'API\'den veri alınamadı, mevcut veriler gösteriliyor'
                ]);
            }

            // API'den gelen veriyi işle
            $standings = [];
            if (isset($apiStandings['standings'])) {
                foreach ($apiStandings['standings'] as $standing) {
                    if (isset($standing['type']) && $standing['type'] === 'TOTAL') {
                        foreach ($standing['table'] as $position) {
                            $standings[] = Standing::updateOrCreate(
                                [
                                    'league_code' => $code,
                                    'team_id' => $position['team']['id'] ?? ''
                                ],
                                [
                                    'position' => $position['position'] ?? 0,
                                    'team_name' => $position['team']['name'] ?? '',
                                    'team_crest' => $position['team']['crest'] ?? '',
                                    'played_games' => $position['playedGames'] ?? 0,
                                    'won' => $position['won'] ?? 0,
                                    'draw' => $position['draw'] ?? 0,
                                    'lost' => $position['lost'] ?? 0,
                                    'goals_for' => $position['goalsFor'] ?? 0,
                                    'goals_against' => $position['goalsAgainst'] ?? 0,
                                    'goal_difference' => $position['goalDifference'] ?? 0,
                                    'points' => $position['points'] ?? 0,
                                    'form' => ''  // Form bilgisini şimdilik boş bırakalım
                                ]
                            );
                        }
                        break;
                    }
                }
            }

            // Eğer veri işlenemediyse
            if (empty($standings)) {
                throw new \Exception('Puan durumu verisi işlenemedi');
            }

            return view('leagues.show', [
                'standings' => ['standings' => [['table' => $standings]]],
                'currentMatchday' => 1
            ]);

        } catch (\Exception $e) {
            Log::error('League show error:', [
                'error' => $e->getMessage(),
                'code' => $code
            ]);
            return back()->with('error', 'Lig bilgileri alınamadı: ' . $e->getMessage());
        }
    }

    private function calculateForm($matches, $teamId)
    {
        if (empty($matches)) {
            return '';
        }

        $form = '';
        $recentMatches = collect($matches)
            ->filter(function($match) use ($teamId) {
                return $match['status'] === 'FINISHED' && 
                    ($match['homeTeam']['id'] === $teamId || 
                     $match['awayTeam']['id'] === $teamId);
            })
            ->sortByDesc('utcDate')
            ->take(5);

        foreach ($recentMatches as $match) {
            $isHome = $match['homeTeam']['id'] === $teamId;
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

        return $form;
    }
} 