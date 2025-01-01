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

            // Stadyum kapasitelerini manuel olarak ekle
            $stadiumCapacities = [
                // Premier League
                65 => ['capacity' => 55097, 'name' => 'Etihad Stadium'], // Manchester City
                66 => ['capacity' => 74310, 'name' => 'Old Trafford'], // Manchester United
                64 => ['capacity' => 53394, 'name' => 'Anfield'], // Liverpool
                61 => ['capacity' => 41837, 'name' => 'Stamford Bridge'], // Chelsea
                57 => ['capacity' => 60704, 'name' => 'Emirates Stadium'], // Arsenal
                73 => ['capacity' => 62850, 'name' => 'Tottenham Hotspur Stadium'], // Tottenham
                
                // La Liga
                86 => ['capacity' => 81044, 'name' => 'Santiago Bernabéu'], // Real Madrid
                81 => ['capacity' => 99354, 'name' => 'Camp Nou'], // Barcelona
                78 => ['capacity' => 70460, 'name' => 'Metropolitano'], // Atletico Madrid
                
                // Bundesliga
                5  => ['capacity' => 75000, 'name' => 'Allianz Arena'], // Bayern Munich
                4  => ['capacity' => 81365, 'name' => 'Signal Iduna Park'], // Dortmund
                721 => ['capacity' => 60449, 'name' => 'Red Bull Arena'], // Leipzig
                
                // Serie A
                98  => ['capacity' => 80018, 'name' => 'San Siro'], // Milan
                108 => ['capacity' => 80018, 'name' => 'San Siro'], // Inter
                109 => ['capacity' => 41507, 'name' => 'Allianz Stadium'], // Juventus
                113 => ['capacity' => 54726, 'name' => 'Diego Armando Maradona'], // Napoli
                
                // Ligue 1
                524 => ['capacity' => 47929, 'name' => 'Parc des Princes'], // PSG
                516 => ['capacity' => 67394, 'name' => 'Vélodrome'], // Marseille
                525 => ['capacity' => 59186, 'name' => 'Groupama Stadium'], // Lyon
            ];
            

            // Eğer takımın ID'si varsa, kapasite bilgisini ekle
            if (isset($stadiumCapacities[$teamId])) {
                $team['venue_capacity'] = $stadiumCapacities[$teamId]['capacity'];
                $team['venue'] = $stadiumCapacities[$teamId]['name'];
            }

            // Takım kadrosunu çek
            $squad = $this->footballApi->get("/teams/{$teamId}/squad");

            // Takımın son maçlarını çek
            $matches = $this->footballApi->get("/teams/{$teamId}/matches?status=FINISHED&limit=10");
            
            // Takımın gelecek maçlarını çek
            $upcomingMatches = $this->footballApi->get("/teams/{$teamId}/matches?status=SCHEDULED&limit=5");

            return view('teams.show', [
                'team' => $team,
                'squad' => $squad['squad'] ?? [],
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