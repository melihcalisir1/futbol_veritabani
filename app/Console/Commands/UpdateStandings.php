<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FootballApiService;
use App\Models\Standing;

class UpdateStandings extends Command
{
    protected $signature = 'standings:update {league?}';
    protected $description = 'Update standings for leagues';

    private $footballApi;

    public function __construct(FootballApiService $footballApi)
    {
        parent::__construct();
        $this->footballApi = $footballApi;
    }

    public function handle()
    {
        $leagues = ['PL', 'BL1', 'PD', 'SA', 'FL1'];
        $leagueArg = $this->argument('league');

        if ($leagueArg) {
            $leagues = [$leagueArg];
        }

        foreach ($leagues as $league) {
            $this->info("Updating standings for {$league}...");
            
            try {
                $standings = $this->footballApi->get("/competitions/{$league}/standings");
                
                if (!isset($standings['standings'][0]['table'])) {
                    $this->error("No standings data found for {$league}");
                    continue;
                }

                // Önce bu lig için eski verileri temizle
                Standing::where('league_code', $league)->delete();

                // Yeni verileri ekle
                foreach ($standings['standings'][0]['table'] as $position) {
                    Standing::create([
                        'league_code' => $league,
                        'position' => $position['position'],
                        'team_id' => $position['team']['id'],
                        'team_name' => $position['team']['name'],
                        'team_crest' => $position['team']['crest'],
                        'played_games' => $position['playedGames'],
                        'won' => $position['won'],
                        'draw' => $position['draw'],
                        'lost' => $position['lost'],
                        'goals_for' => $position['goalsFor'],
                        'goals_against' => $position['goalsAgainst'],
                        'goal_difference' => $position['goalDifference'],
                        'points' => $position['points'],
                        'form' => $position['form'] ?? null
                    ]);
                }

                $this->info("Standings updated for {$league}");
            } catch (\Exception $e) {
                $this->error("Error updating {$league}: " . $e->getMessage());
            }
        }
    }
} 