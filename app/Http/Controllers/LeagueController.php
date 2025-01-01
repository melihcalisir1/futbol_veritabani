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

            // Sezonları filtrele ve sırala (1989'dan sonrası)
            if (isset($league['seasons'])) {
                $league['seasons'] = collect($league['seasons'])
                    ->filter(function($season) {
                        return (int)substr($season['startDate'], 0, 4) >= 1989;
                    })
                    ->map(function($season) {
                        // Eğer winner bilgisi yoksa manuel ekleyelim
                        if (!isset($season['winner'])) {
                            $startYear = substr($season['startDate'], 0, 4);
                            $winners = [
                                '2023' => ['name' => 'Bayer 04 Leverkusen', 'crest' => 'https://crests.football-data.org/3.png'],
                                '2022' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2021' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2020' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2019' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2018' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2017' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2016' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2015' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2014' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2013' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2012' => ['name' => 'Borussia Dortmund', 'crest' => 'https://crests.football-data.org/4.png'],
                                '2011' => ['name' => 'Borussia Dortmund', 'crest' => 'https://crests.football-data.org/4.png'],
                                '2010' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2009' => ['name' => 'VfL Wolfsburg', 'crest' => 'https://crests.football-data.org/11.png'],
                                '2008' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2007' => ['name' => 'VfB Stuttgart', 'crest' => 'https://crests.football-data.org/10.png'],
                                '2006' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2005' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2004' => ['name' => 'Werder Bremen', 'crest' => 'https://crests.football-data.org/12.png'],
                                '2003' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2002' => ['name' => 'Borussia Dortmund', 'crest' => 'https://crests.football-data.org/4.png'],
                                '2001' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '2000' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '1999' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '1998' => ['name' => 'Kaiserslautern', 'crest' => '/images/leagues/default-team.png'],
                                '1997' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '1996' => ['name' => 'Borussia Dortmund', 'crest' => 'https://crests.football-data.org/4.png'],
                                '1995' => ['name' => 'Borussia Dortmund', 'crest' => 'https://crests.football-data.org/4.png'],
                                '1994' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '1993' => ['name' => 'Werder Bremen', 'crest' => 'https://crests.football-data.org/12.png'],
                                '1992' => ['name' => 'VfB Stuttgart', 'crest' => 'https://crests.football-data.org/10.png'],
                                '1991' => ['name' => 'Kaiserslautern', 'crest' => '/images/leagues/default-team.png'],
                                '1990' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                                '1989' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
                            ];

                            if (isset($winners[$startYear])) {
                                $season['winner'] = $winners[$startYear];
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