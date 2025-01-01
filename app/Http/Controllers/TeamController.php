<?php

namespace App\Http\Controllers;

use App\Services\FootballApiService;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    protected $footballApi;

    public function __construct(FootballApiService $footballApi)
    {
        $this->footballApi = $footballApi;
    }

    public function show($teamId)
    {
        try {
            // Takım bilgilerini çek
            $team = $this->footballApi->get("/teams/{$teamId}");
            if (!$team) {
                throw new \Exception('Takım bilgileri alınamadı');
            }

            // Takımın son maçlarını çek
            $matches = $this->footballApi->get("/teams/{$teamId}/matches?status=FINISHED&limit=10");
            
            // Takımın gelecek maçlarını çek
            $upcomingMatches = $this->footballApi->get("/teams/{$teamId}/matches?status=SCHEDULED&limit=5");

            return view('teams.show', [
                'team' => $team,
                'recentMatches' => $matches['matches'] ?? [],
                'upcomingMatches' => $upcomingMatches['matches'] ?? []
            ]);

        } catch (\Exception $e) {
            Log::error('Team show error:', [
                'error' => $e->getMessage(),
                'teamId' => $teamId
            ]);
            return back()->with('error', 'Takım bilgileri alınamadı: ' . $e->getMessage());
        }
    }
} 