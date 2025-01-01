@extends('layouts.app')

@section('title', $team['name'] ?? 'Takım Detayları')

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <!-- Geri Butonu -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}#puan-durumu" 
               class="inline-flex items-center space-x-2 text-gray-400 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Puan Durumuna Dön</span>
            </a>
        </div>

        <!-- Takım Başlığı ve Temel Bilgiler -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Sol: Logo ve İsim -->
            <div class="flex items-center space-x-4">
                <img src="{{ $team['crest'] }}" alt="{{ $team['name'] }}" class="w-24 h-24">
                <div>
                    <h1 class="text-2xl font-bold">{{ $team['name'] }}</h1>
                    <p class="text-gray-400">{{ $team['area']['name'] }}</p>
                </div>
            </div>

            <!-- Orta: Stadyum Bilgileri -->
            <div class="bg-[#1a1f2d] rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Stadyum Bilgileri</h2>
                <div class="space-y-2">
                    <p><span class="text-gray-400">Stadyum:</span> {{ $team['venue'] }}</p>
                    <p><span class="text-gray-400">Kapasite:</span> {{ number_format($team['venue_capacity'] ?? 0) }}</p>
                    <p><span class="text-gray-400">Konum:</span> {{ $team['address'] }}</p>
                </div>
            </div>

            <!-- Sağ: Kulüp Bilgileri -->
            <div class="bg-[#1a1f2d] rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Kulüp Bilgileri</h2>
                <div class="space-y-2">
                    <p><span class="text-gray-400">Kuruluş:</span> {{ $team['founded'] }}</p>
                    <p><span class="text-gray-400">Teknik Direktör:</span> {{ $team['coach']['name'] ?? 'Bilgi yok' }}</p>
                    <p><span class="text-gray-400">Başkan:</span> {{ $team['president'] ?? 'Bilgi yok' }}</p>
                </div>
            </div>
        </div>

        <!-- Takım Kadrosu -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Takım Kadrosu</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($squad ?? [] as $player)
                    <div class="bg-[#1a1f2d] rounded-lg p-4 flex items-center space-x-4">
                        <img src="{{ $player['photo'] ?? '' }}" alt="{{ $player['name'] }}" 
                             class="w-12 h-12 rounded-full object-cover bg-gray-800">
                        <div>
                            <p class="font-semibold">{{ $player['name'] }}</p>
                            <p class="text-sm text-gray-400">{{ $player['position'] }}</p>
                            <p class="text-sm text-gray-400">{{ $player['nationality'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Son Maçlar -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Son Maçlar</h2>
            <div class="space-y-3">
                @foreach($recentMatches as $match)
                    <div class="bg-[#1a1f2d] rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3 w-[40%]">
                                <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-6 h-6">
                                <span class="text-white">{{ $match['homeTeam']['shortName'] }}</span>
                            </div>
                            <div class="flex items-center justify-center w-[20%]">
                                <span class="text-lg font-bold">
                                    {{ $match['score']['fullTime']['home'] }} - {{ $match['score']['fullTime']['away'] }}
                                </span>
                            </div>
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
                            <div class="flex items-center space-x-3 w-[40%]">
                                <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-6 h-6">
                                <span class="text-white">{{ $match['homeTeam']['shortName'] }}</span>
                            </div>
                            <div class="w-[20%] text-center">
                                <span class="text-gray-400">vs</span>
                            </div>
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