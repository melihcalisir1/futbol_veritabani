<?php

namespace App\Http\Controllers;

use App\Services\FootballApiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MatchController extends Controller
{
    protected $footballApi;

    public function __construct(FootballApiService $footballApi)
    {
        $this->footballApi = $footballApi;
    }

    public function index()
    {
        try {
            Carbon::setLocale('tr');
            date_default_timezone_set('Europe/Istanbul');
            
            $date = request('date', now()->format('Y-m-d'));
            $currentDate = Carbon::parse($date);
            
            $matches = $this->footballApi->getMatchesByDate($date);

            $matchesByLeague = collect($matches['matches'] ?? [])
                ->map(function ($match) {
                    $utcDate = Carbon::parse($match['utcDate']);
                    $match['utcDate'] = $utcDate->setTimezone('Europe/Istanbul');
                    
                    $match['homeTeam']['displayName'] = $match['homeTeam']['shortName'] ?? $match['homeTeam']['name'];
                    $match['awayTeam']['displayName'] = $match['awayTeam']['shortName'] ?? $match['awayTeam']['name'];
                    
                    return $match;
                })
                ->filter(function ($match) use ($date) {
                    return $match['utcDate']->format('Y-m-d') === $date;
                })
                ->groupBy('competition.name')
                ->sortBy(function ($matches, $leagueName) {
                    $order = [
                        'Premier League' => 1,
                        'La Liga' => 2,
                        'Bundesliga' => 3,
                        'Serie A' => 4,
                        'Ligue 1' => 5
                    ];
                    return $order[$leagueName] ?? 999;
                });

            return view('matches.index', [
                'matchesByLeague' => $matchesByLeague,
                'currentDate' => $currentDate
            ]);
        } catch (\Exception $e) {
            Log::error('Error in index', ['error' => $e->getMessage()]);
            return view('matches.index', [
                'matchesByLeague' => collect(),
                'currentDate' => Carbon::parse($date),
                'error' => 'Bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function finished()
    {
        try {
            $matches = $this->footballApi->getFinishedMatches();
            $matchesByLeague = collect($matches['matches'] ?? [])->groupBy('competition.name');
            
            return view('matches.index', [
                'matchesByLeague' => $matchesByLeague,
                'currentDate' => Carbon::now()
            ]);
        } catch (\Exception $e) {
            return view('matches.index', [
                'matchesByLeague' => collect(),
                'currentDate' => Carbon::now(),
                'error' => 'Bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function scheduled()
    {
        try {
            $matches = $this->footballApi->getScheduledMatches();
            $matchesByLeague = collect($matches['matches'] ?? [])->groupBy('competition.name');
            
            return view('matches.index', [
                'matchesByLeague' => $matchesByLeague,
                'currentDate' => Carbon::now()
            ]);
        } catch (\Exception $e) {
            return view('matches.index', [
                'matchesByLeague' => collect(),
                'currentDate' => Carbon::now(),
                'error' => 'Bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }

    public function odds()
    {
        return $this->scheduled();
    }
} 