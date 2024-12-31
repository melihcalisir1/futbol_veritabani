@extends('layouts.app')

@section('title', 'All Matches')

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    <!-- Üst Navigasyon -->
    <div class="border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex space-x-4">
                    <a href="{{ route('matches.all') }}" 
                       class="{{ request()->routeIs('matches.all') ? 'bg-red-600' : 'hover:bg-gray-800' }} px-4 py-2 rounded">
                        ALL
                    </a>
                    <a href="{{ route('matches.odds') }}"
                       class="{{ request()->routeIs('matches.odds') ? 'bg-red-600' : 'hover:bg-gray-800' }} px-4 py-2 rounded">
                        ODDS
                    </a>
                    <a href="{{ route('matches.finished') }}"
                       class="{{ request()->routeIs('matches.finished') ? 'bg-red-600' : 'hover:bg-gray-800' }} px-4 py-2 rounded">
                        FINISHED
                    </a>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="?date={{ $currentDate->copy()->subDay()->format('Y-m-d') }}" 
                       class="text-gray-400 hover:text-white">&lt;</a>
                    <span class="bg-gray-800 px-3 py-1 rounded">
                        {{ $currentDate->format('d/m D') }}
                    </span>
                    <a href="?date={{ $currentDate->copy()->addDay()->format('Y-m-d') }}" 
                       class="text-gray-400 hover:text-white">&gt;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ana İçerik -->
    <div class="container mx-auto px-4 py-4">
        @foreach($matchesByLeague as $leagueName => $leagueMatches)
            <!-- Lig Başlığı -->
            <div class="mb-4">
                <div class="flex items-center justify-between p-2 text-gray-400 border-b border-gray-800">
                    <div class="flex items-center space-x-2">
                        <button class="text-gray-600 hover:text-white">⭐</button>
                        <img src="{{ $leagueMatches->first()['competition']['emblem'] ?? '' }}" 
                             alt="" class="w-5 h-5">
                        <span class="uppercase text-gray-500">{{ $leagueName }}</span>
                    </div>
                    <a href="{{ route('league.show', $leagueMatches->first()['competition']['code']) }}" 
                       class="text-blue-500 hover:underline">
                        Standings
                    </a>
                </div>

                @foreach($leagueMatches as $match)
                    <div class="hover:bg-gray-800 group">
                        <div class="flex items-center px-4 py-2">
                            <!-- Saat -->
                            <div class="w-16 text-gray-500">
                                {{ Carbon\Carbon::parse($match['utcDate'])->format('H:i') }}
                            </div>

                            <!-- Takımlar -->
                            <div class="flex-1">
                                <!-- Ev Sahibi -->
                                <div class="flex items-center space-x-3 mb-1">
                                    <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-5 h-5">
                                    <span class="text-white">{{ $match['homeTeam']['name'] }}</span>
                                </div>

                                <!-- Deplasman -->
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $match['awayTeam']['crest'] }}" alt="" class="w-5 h-5">
                                    <span class="text-white">{{ $match['awayTeam']['name'] }}</span>
                                </div>
                            </div>

                            <!-- Skor/Durum -->
                            <div class="w-20 text-center">
                                @if($match['status'] === 'FINISHED')
                                    <span class="text-white">
                                        {{ $match['score']['fullTime']['home'] }} - {{ $match['score']['fullTime']['away'] }}
                                    </span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </div>

                            <!-- Butonlar -->
                            <div class="flex items-center space-x-3 ml-4">
                                @if($match['status'] !== 'FINISHED')
                                    <button class="bg-gray-700 px-2 py-1 rounded text-xs">PREVIEW</button>
                                @endif
                                <button class="text-gray-400 hover:text-white">🎧</button>
                                <button class="text-gray-400 hover:text-white">📺</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection 