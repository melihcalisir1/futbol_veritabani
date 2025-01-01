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
        // Sidebardaki tüm ligler ve API kodları
        $leagues = [
            // Major Leagues
            'PL'  => 'Premier League',     // İngiltere
            'PD'  => 'La Liga',            // İspanya
            'BL1' => 'Bundesliga',         // Almanya
            'SA'  => 'Serie A',            // İtalya
            'FL1' => 'Ligue 1',            // Fransa
            
            // Other Leagues
            'ERE' => 'Eredivisie',         // Hollanda
            'PPL' => 'Primeira Liga',      // Portekiz
            'ELC' => 'Championship',       // İngiltere 2. Lig
            'BSA' => 'Brasileirão',        // Brezilya
            
            // International
            'CLI' => 'Copa Libertadores',  // Güney Amerika
            'CL'  => 'Champions League',   // UEFA
            'EC'  => 'European Championship', // EURO
            'WC'  => 'World Cup'           // FIFA
        ];

        $leagueArg = $this->argument('league');

        if ($leagueArg) {
            $leagues = [$leagueArg => $leagues[$leagueArg] ?? ''];
        }

        foreach ($leagues as $code => $name) {
            $this->info("Updating standings for {$name} ({$code})...");
            
            try {
                // Bazı ligler için özel endpoint kullanımı
                $endpoint = "/competitions/{$code}/standings";
                
                // Eredivisie için özel kod düzeltmesi
                if ($code === 'ERE') {
                    $endpoint = "/competitions/DED/standings";
                }
                
                // Brasileirao için özel kod düzeltmesi
                if ($code === 'BSA') {
                    $endpoint = "/competitions/BSA/standings?season=" . date('Y');
                }

                $standings = $this->footballApi->get($endpoint);
                
                if (!isset($standings['standings'][0]['table'])) {
                    $this->error("No standings data found for {$name} ({$code})");
                    continue;
                }

                // Önce bu lig için eski verileri temizle
                $dbCode = ($code === 'ERE') ? 'DED' : $code;
                Standing::where('league_code', $dbCode)->delete();

                // Yeni verileri ekle
                foreach ($standings['standings'][0]['table'] as $position) {
                    Standing::create([
                        'league_code' => $dbCode,
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

                $this->info("Standings updated for {$name} ({$code})");
                
                // API rate limit'e takılmamak için her istek arasında biraz bekle
                sleep(2);
                
            } catch (\Exception $e) {
                $this->error("Error updating {$name} ({$code}): " . $e->getMessage());
                // Hata durumunda da bekle
                sleep(2);
                continue;
            }
        }
    }
} 