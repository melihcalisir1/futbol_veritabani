@extends('layouts.app')

@section('title', $team['name'] ?? 'Takım Detayları')

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <!-- Geri Butonu -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}#fikstur" 
               class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Fikstüre Dön</span>
            </a>
        </div>

        <!-- Takım Başlığı -->
        <div class="flex items-center space-x-4 mb-8">
            <img src="{{ $team['crest'] }}" alt="{{ $team['name'] }}" class="w-16 h-16">
            <div>
                <h1 class="text-2xl font-bold">{{ $team['name'] }}</h1>
                <p class="text-gray-400">{{ $team['venue'] }} • {{ $team['area']['name'] }}</p>
            </div>
        </div>

        <!-- Son Maçlar -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Son Maçlar</h2>
            <div class="space-y-3">
                @foreach($recentMatches as $match)
                    <div class="bg-[#1a1f2d] rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <!-- Ev Sahibi -->
                            <div class="flex items-center space-x-3 w-[40%]">
                                <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-6 h-6">
                                <span class="text-white">{{ $match['homeTeam']['shortName'] }}</span>
                            </div>

                            <!-- Skor -->
                            <div class="flex items-center justify-center w-[20%]">
                                <span class="text-lg font-bold">
                                    {{ $match['score']['fullTime']['home'] }} - {{ $match['score']['fullTime']['away'] }}
                                </span>
                            </div>

                            <!-- Deplasman -->
                            <div class="flex items-center justify-end space-x-3 w-[40%]">
                                <span class="text-white">{{ $match['awayTeam']['shortName'] }}</span>
                                <img src="{{ $match['awayTeam']['crest'] }}" alt="" class="w-6 h-6">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Gelecek Maçlar -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Gelecek Maçlar</h2>
            <div class="space-y-3">
                @foreach($upcomingMatches as $match)
                    <div class="bg-[#1a1f2d] rounded-lg p-4">
                        <div class="text-gray-400 text-sm mb-2">
                            {{ \Carbon\Carbon::parse($match['utcDate'])
                                ->timezone('Europe/Istanbul')
                                ->format('d.m.Y H:i') }}
                        </div>
                        <div class="flex items-center justify-between">
                            <!-- Ev Sahibi -->
                            <div class="flex items-center space-x-3 w-[40%]">
                                <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-6 h-6">
                                <span class="text-white">{{ $match['homeTeam']['shortName'] }}</span>
                            </div>

                            <!-- vs -->
                            <div class="w-[20%] text-center">
                                <span class="text-gray-400">vs</span>
                            </div>

                            <!-- Deplasman -->
                            <div class="flex items-center justify-end space-x-3 w-[40%]">
                                <span class="text-white">{{ $match['awayTeam']['shortName'] }}</span>
                                <img src="{{ $match['awayTeam']['crest'] }}" alt="" class="w-6 h-6">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 