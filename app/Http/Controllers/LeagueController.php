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
                            
                            $winners = [
                                'PL' => [ // Premier League
                                    '2023' => ['name' => 'Manchester City FC', 'crest' => 'https://crests.football-data.org/65.png'],
                                    '2022' => ['name' => 'Manchester City FC', 'crest' => 'https://crests.football-data.org/65.png'],
                                    '2021' => ['name' => 'Manchester City FC', 'crest' => 'https://crests.football-data.org/65.png'],
                                    '2020' => ['name' => 'Manchester City FC', 'crest' => 'https://crests.football-data.org/65.png'],
                                    '2019' => ['name' => 'Liverpool FC', 'crest' => 'https://crests.football-data.org/64.png'],
                                    '2018' => ['name' => 'Manchester City FC', 'crest' => 'https://crests.football-data.org/65.png'],
                                    '2017' => ['name' => 'Chelsea FC', 'crest' => 'https://crests.football-data.org/61.png'],
                                    '2016' => ['name' => 'Leicester City FC', 'crest' => 'https://crests.football-data.org/338.png'],
                                    '2015' => ['name' => 'Chelsea FC', 'crest' => 'https://crests.football-data.org/61.png'],
                                    '2014' => ['name' => 'Manchester City FC', 'crest' => 'https://crests.football-data.org/65.png'],
                                    '2013' => ['name' => 'Manchester United FC', 'crest' => 'https://crests.football-data.org/66.png'],
                                    '2012' => ['name' => 'Manchester City FC', 'crest' => 'https://crests.football-data.org/65.png'],
                                    '2011' => ['name' => 'Manchester United FC', 'crest' => 'https://crests.football-data.org/66.png'],
                                    '2010' => ['name' => 'Chelsea FC', 'crest' => 'https://crests.football-data.org/61.png'],
                                    '2009' => ['name' => 'Manchester United FC', 'crest' => 'https://crests.football-data.org/66.png'],
                                    '2008' => ['name' => 'Manchester United FC', 'crest' => 'https://crests.football-data.org/66.png'],
                                    '2007' => ['name' => 'Manchester United FC', 'crest' => 'https://crests.football-data.org/66.png'],
                                    '2006' => ['name' => 'Chelsea FC', 'crest' => 'https://crests.football-data.org/61.png'],
                                    '2005' => ['name' => 'Chelsea FC', 'crest' => 'https://crests.football-data.org/61.png'],
                                    '2004' => ['name' => 'Arsenal FC', 'crest' => 'https://crests.football-data.org/57.png'],
                                    '2003' => ['name' => 'Manchester United FC', 'crest' => 'https://crests.football-data.org/66.png'],
                                    '2002' => ['name' => 'Arsenal FC', 'crest' => 'https://crests.football-data.org/57.png'],
                                    '2001' => ['name' => 'Manchester United FC', 'crest' => 'https://crests.football-data.org/66.png'],
                                    '2000' => ['name' => 'Manchester United FC', 'crest' => 'https://crests.football-data.org/66.png'],
                                ],
                                'BL1' => [ // Bundesliga
                                    '2023' => ['name' => 'Bayern München', 'crest' => 'https://crests.football-data.org/5.png'],
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
                                ],
                                // Diğer ligler için benzer şekilde devam edebilirsiniz...
                            ];

                            if (isset($winners[$code][$startYear])) {
                                $season['winner'] = $winners[$code][$startYear];
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
                ->get();

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