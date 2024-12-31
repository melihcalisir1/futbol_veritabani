<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class FootballApiService
{
    private string $baseUrl = 'https://api.football-data.org/v4';
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('FOOTBALL_API_KEY');
    }

    private function getHeaders()
    {
        return [
            'X-Auth-Token' => $this->apiKey
        ];
    }

    public function get($endpoint)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . $endpoint);

            // API yanıtını detaylı logla
            Log::debug('API Raw Response:', [
                'endpoint' => $endpoint,
                'status' => $response->status(),
                'headers' => $response->headers(),
                'body' => $response->body()
            ]);

            if (!$response->successful()) {
                Log::error('API Error:', [
                    'endpoint' => $endpoint,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return null;
            }

            $data = $response->json();
            
            // JSON yanıtını logla
            Log::debug('API JSON Response:', [
                'endpoint' => $endpoint,
                'data' => $data
            ]);

            return $data;
        } catch (\Exception $e) {
            Log::error('API Request Error:', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    public function getMatchesByDate($date)
    {
        try {
            // Tek bir günün maçlarını çekelim
            $response = $this->get("/matches?dateFrom={$date}&dateTo={$date}");
            
            // Eğer maç yoksa, tarihi genişletelim
            if (empty($response['matches'])) {
                $startDate = Carbon::parse($date)->subDays(3)->format('Y-m-d');
                $endDate = Carbon::parse($date)->addDays(3)->format('Y-m-d');
                $response = $this->get("/matches?dateFrom={$startDate}&dateTo={$endDate}");
            }

            return $response;
        } catch (\Exception $e) {
            Log::error('Error in getMatchesByDate', ['error' => $e->getMessage()]);
            return ['matches' => []];
        }
    }

    public function getFinishedMatches()
    {
        try {
            return $this->get("/matches?status=FINISHED");
        } catch (\Exception $e) {
            Log::error('Error in getFinishedMatches', ['error' => $e->getMessage()]);
            return ['matches' => []];
        }
    }

    public function getScheduledMatches()
    {
        try {
            return $this->get("/matches?status=SCHEDULED");
        } catch (\Exception $e) {
            Log::error('Error in getScheduledMatches', ['error' => $e->getMessage()]);
            return ['matches' => []];
        }
    }

    public function getTodayMatches()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->get("/matches?dateFrom={$today}&dateTo={$today}");
    }
} 