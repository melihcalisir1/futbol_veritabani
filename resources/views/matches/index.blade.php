@extends('layouts.app')

@section('title', 'All Matches')

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    <!-- Üst Navigasyon -->
    <div class="border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Tarih Seçici -->
                <div class="flex items-center space-x-4">
                    <a href="?date={{ $currentDate->copy()->subDay()->format('Y-m-d') }}" 
                       class="text-gray-400 hover:text-white">
                        <span class="text-sm">{{ $currentDate->copy()->subDay()->isoFormat('D MMMM dddd') }}</span>
                    </a>
                    <span class="bg-gray-800 px-4 py-2 rounded font-medium">
                        {{ $currentDate->isoFormat('D MMMM dddd') }}
                    </span>
                    <a href="?date={{ $currentDate->copy()->addDay()->format('Y-m-d') }}" 
                       class="text-gray-400 hover:text-white">
                        <span class="text-sm">{{ $currentDate->copy()->addDay()->isoFormat('D MMMM dddd') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ana İçerik -->
    <div class="container mx-auto px-4 py-4">
        @forelse($matchesByLeague as $leagueName => $leagueMatches)
            <!-- Lig Başlığı -->
            <div class="mb-6">
                <div class="flex items-center justify-between p-2 text-gray-400 border-b border-gray-800">
                    <div class="flex items-center space-x-2">
                        <img src="{{ $leagueMatches->first()['competition']['emblem'] ?? '' }}" 
                             alt="" class="w-5 h-5">
                        <span class="uppercase text-gray-500">{{ $leagueName }}</span>
                    </div>
                    <a href="{{ route('league.show', $leagueMatches->first()['competition']['code']) }}" 
                       class="text-blue-500 hover:underline">
                        Standings
                    </a>
                </div>

                @foreach($leagueMatches->sortBy('utcDate') as $match)
                    <div class="hover:bg-gray-800 group py-2">
                        <div class="flex items-center">
                            <!-- Sol Taraf: Saat ve Ev Sahibi -->
                            <div class="flex items-center flex-1">
                                <div class="text-gray-500 text-sm w-16 px-4">
                                    {{ $match['utcDate']->format('H:i') }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-6 h-6">
                                    <span class="text-white">{{ $match['homeTeam']['displayName'] }}</span>
                                </div>
                            </div>

                            <!-- Orta: vs -->
                            <div class="w-20 text-center font-medium text-gray-500">
                                vs
                            </div>

                            <!-- Sağ Taraf: Deplasman -->
                            <div class="flex items-center space-x-2 flex-1 justify-end px-4">
                                <span class="text-white">{{ $match['awayTeam']['displayName'] }}</span>
                                <img src="{{ $match['awayTeam']['crest'] }}" alt="" class="w-6 h-6">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
            <div class="text-center py-8">
                <p class="text-gray-500">Bu tarihte oynanacak maç bulunmuyor.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection 