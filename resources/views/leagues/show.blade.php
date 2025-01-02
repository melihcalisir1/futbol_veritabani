@extends('layouts.app')

@section('title', 'Lig Detayları')

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    <!-- Geri Butonu -->
    <div class="container mx-auto px-4 py-2">
        <div class="flex justify-end">
            <a href="/" class="text-gray-400 hover:text-white flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Geri</span>
            </a>
        </div>
    </div>

    <!-- Sekmeler -->
    <div class="border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex space-x-8 py-4">
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="genel">GENEL</a>
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="sonuclar">SONUÇLAR</a>
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="fikstur">FİKSTÜR</a>
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="oranlar">ORANLAR</a>
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="puan-durumu">PUAN DURUMU</a>
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="arsiv">ARŞİV</a>
            </div>
        </div>
    </div>

    <!-- Tab İçerikleri -->
    <div class="container mx-auto px-4 py-6">
        <!-- Genel Tab -->
        <div id="genel" class="tab-content hidden">
            <!-- Lig Başlığı -->
            <div class="mb-4">
                <div class="flex items-center space-x-3 mb-4">
                    @if(isset($league['emblem']))
                        <img src="{{ $league['emblem'] }}" alt="{{ $league['name'] ?? '' }}" class="w-8 h-8">
                    @endif
                    <div>
                        <h1 class="text-lg font-bold">{{ $league['name'] ?? 'Lig Adı' }}</h1>
                        <p class="text-xs text-gray-400">
                            {{ $league['area']['name'] ?? '' }}
                            @if(isset($league['currentSeason']))
                                - {{ $league['currentSeason']['startDate'] }} / {{ $league['currentSeason']['endDate'] }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Mevcut hafta maçları -->
                <div class="space-y-4">
                    @foreach($recentMatches as $matchday => $matchGroup)
                        <div class="space-y-1">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-sm">{{ $matchday }}. MAÇ GÜNÜ</h3>
                                
                            </div>

                            <!-- Maçlar -->
                            @foreach($matchGroup as $match)
                                <div class="bg-gray-800 rounded p-2">
                                    <div class="text-gray-400 text-[11px] mb-1">
                                        {{ \Carbon\Carbon::parse($match['utcDate'])
                                            ->timezone('Europe/Istanbul')
                                            ->format('H:i') }}
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <!-- Ev Sahibi -->
                                        <div class="flex items-center space-x-1.5 flex-1">
                                            <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-4 h-4">
                                            <span class="text-xs">{{ $match['homeTeam']['name'] }}</span>
                                        </div>

                                        <!-- Skor -->
                                        <div class="flex items-center px-2">
                                            @if($match['status'] === 'FINISHED')
                                                <span class="text-xs font-bold">
                                                    {{ $match['score']['fullTime']['home'] }} - {{ $match['score']['fullTime']['away'] }}
                                                </span>
                                            @elseif($match['status'] === 'IN_PLAY' || $match['status'] === 'PAUSED')
                                                <div class="flex flex-col items-center">
                                                    <span class="text-[11px] text-red-500 mb-0.5">
                                                        @if($match['status'] === 'PAUSED')
                                                            Devre
                                                        @else
                                                            {{ $match['minute'] ?? '' }}'
                                                        @endif
                                                    </span>
                                                    <span class="text-xs font-bold">
                                                        {{ $match['score']['fullTime']['home'] ?? 0 }} - {{ $match['score']['fullTime']['away'] ?? 0 }}
                                                    </span>
                                                </div>
                                            @else
                                                <span class="text-gray-500 text-xs">vs</span>
                                            @endif
                                        </div>

                                        <!-- Deplasman -->
                                        <div class="flex items-center justify-end space-x-1.5 flex-1">
                                            <span class="text-xs">{{ $match['awayTeam']['name'] }}</span>
                                            <img src="{{ $match['awayTeam']['crest'] }}" alt="" class="w-4 h-4">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sonuçlar Tab -->
        <div id="sonuclar" class="tab-content hidden">
            @foreach($matches['matches'] ?? [] as $match)
                @php
                    $matchGroups = collect($matches['matches'])
                        ->filter(function($m) {
                            return $m['status'] === 'FINISHED';
                        })
                        ->groupBy('matchday')
                        ->sortByDesc('matchday');
                @endphp

                @foreach($matchGroups as $matchday => $dayMatches)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-white mb-4 border-b border-gray-800 pb-2">{{ $matchday }}. Hafta</h3>
                        <div class="space-y-3">
                            @foreach($dayMatches as $match)
                                <div class="bg-[#1a1f2d] rounded-lg p-4 hover:bg-[#242938] transition-colors">
                                    <div class="flex items-center justify-between">
                                        <!-- Tarih ve Saat -->
                                        <div class="text-gray-400 text-xs w-20">
                                            {{ \Carbon\Carbon::parse($match['utcDate'])
                                                ->timezone('Europe/Istanbul')
                                                ->format('d.m.Y H:i') }}
                                        </div>

                                        <!-- Ev Sahibi -->
                                        <div class="flex items-center justify-end space-x-3 w-[35%]">
                                            <span class="text-white text-sm">{{ $match['homeTeam']['shortName'] ?? $match['homeTeam']['name'] }}</span>
                                            <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-6 h-6 object-contain">
                                        </div>

                                        <!-- Skor -->
                                        <div class="flex items-center justify-center w-[90px] px-4">
                                            <span class="text-white font-bold text-lg tracking-wider">
                                                {{ $match['score']['fullTime']['home'] }} - {{ $match['score']['fullTime']['away'] }}
                                            </span>
                                        </div>

                                        <!-- Deplasman -->
                                        <div class="flex items-center space-x-3 w-[35%]">
                                            <img src="{{ $match['awayTeam']['crest'] }}" alt="" class="w-6 h-6 object-contain">
                                            <span class="text-white text-sm">{{ $match['awayTeam']['shortName'] ?? $match['awayTeam']['name'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                @break
            @endforeach
        </div>

        <!-- Fikstür Tab -->
        <div id="fikstur" class="tab-content hidden">
            <div class="space-y-4">
                @php
                    $futureMatches = collect($matches['matches'])
                        ->filter(function($match) {
                            return $match['status'] === 'SCHEDULED' || $match['status'] === 'TIMED';
                        })
                        ->groupBy('matchday')
                        ->sortBy('matchday');
                @endphp

                @foreach($futureMatches as $matchday => $dayMatches)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-white mb-4 border-b border-gray-800 pb-2">{{ $matchday }}. Hafta</h3>
                        <div class="space-y-3">
                            @foreach($dayMatches->sortBy('utcDate') as $match)
                                <div class="bg-[#1a1f2d] rounded-lg p-4 hover:bg-[#242938] transition-colors">
                                    <div class="flex items-center justify-between">
                                        <!-- Tarih ve Saat -->
                                        <div class="text-gray-400 text-xs w-20">
                                            {{ \Carbon\Carbon::parse($match['utcDate'])
                                                ->timezone('Europe/Istanbul')
                                                ->format('d.m.Y H:i') }}
                                        </div>

                                        <!-- Ev Sahibi -->
                                        <div class="flex items-center justify-end space-x-3 w-[35%]">
                                            <span class="text-white text-sm">{{ $match['homeTeam']['shortName'] ?? $match['homeTeam']['name'] }}</span>
                                            <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-6 h-6 object-contain">
                                        </div>

                                        <!-- vs -->
                                        <div class="flex items-center justify-center w-[90px] px-4">
                                            <span class="text-gray-500 text-sm">vs</span>
                                        </div>

                                        <!-- Deplasman -->
                                        <div class="flex items-center space-x-3 w-[35%]">
                                            <img src="{{ $match['awayTeam']['crest'] }}" alt="" class="w-6 h-6 object-contain">
                                            <span class="text-white text-sm">{{ $match['awayTeam']['shortName'] ?? $match['awayTeam']['name'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Oranlar Tab -->
        <div id="oranlar" class="tab-content hidden">
            <div class="space-y-4">
                @php
                    $futureMatches = collect($matches['matches'])
                        ->filter(function($match) {
                            return $match['status'] === 'SCHEDULED' || $match['status'] === 'TIMED';
                        })
                        ->sortBy('utcDate');
                @endphp

                @foreach($futureMatches as $match)
                    <div class="bg-[#1a1f2d] rounded-lg p-4">
                        <!-- Tarih/Saat -->
                        <div class="text-gray-400 text-sm mb-3">
                            {{ \Carbon\Carbon::parse($match['utcDate'])
                                ->timezone('Europe/Istanbul')
                                ->format('d.m.Y H:i') }}
                        </div>

                        <div class="flex items-center justify-between">
                            <!-- Ev Sahibi -->
                            <div class="flex items-center space-x-3 w-[35%]">
                                <img src="{{ $match['homeTeam']['crest'] }}" alt="" class="w-6 h-6">
                                <span class="text-white">{{ $match['homeTeam']['shortName'] ?? $match['homeTeam']['name'] }}</span>
                            </div>

                            <!-- Oranlar -->
                            <div class="flex items-center space-x-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-gray-400 text-xs mb-1">1</span>
                                    <div class="bg-[#242938] px-4 py-2 rounded">
                                        <span class="text-green-500 font-medium">{{ isset($matchOdds[$match['id']]) ? $matchOdds[$match['id']]->home_win_odds : '-' }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-col items-center">
                                    <span class="text-gray-400 text-xs mb-1">X</span>
                                    <div class="bg-[#242938] px-4 py-2 rounded">
                                        <span class="text-yellow-500 font-medium">{{ isset($matchOdds[$match['id']]) ? $matchOdds[$match['id']]->draw_odds : '-' }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-col items-center">
                                    <span class="text-gray-400 text-xs mb-1">2</span>
                                    <div class="bg-[#242938] px-4 py-2 rounded">
                                        <span class="text-red-500 font-medium">{{ isset($matchOdds[$match['id']]) ? $matchOdds[$match['id']]->away_win_odds : '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Deplasman -->
                            <div class="flex items-center justify-end space-x-3 w-[35%]">
                                <span class="text-white">{{ $match['awayTeam']['shortName'] ?? $match['awayTeam']['name'] }}</span>
                                <img src="{{ $match['awayTeam']['crest'] }}" alt="" class="w-6 h-6">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Puan Durumu Tab -->
        <div id="puan-durumu" class="tab-content hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-800">
                            <th class="text-left py-2 px-2">#</th>
                            <th class="text-left py-2 px-2">TAKIM</th>
                            <th class="text-center py-2 px-2">O</th>
                            <th class="text-center py-2 px-2">G</th>
                            <th class="text-center py-2 px-2">B</th>
                            <th class="text-center py-2 px-2">M</th>
                            <th class="text-center py-2 px-2">AG</th>
                            <th class="text-center py-2 px-2">YG</th>
                            <th class="text-center py-2 px-2">AV</th>
                            <th class="text-center py-2 px-2">P</th>
                            <th class="text-center py-2 px-2">FORM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($standings['standings'][0]['table'] ?? [] as $position)
                            <tr class="border-b border-gray-700 hover:bg-gray-800 transition-colors cursor-pointer">
                                <td class="py-2 px-2">{{ $position['position'] }}</td>
                                <td class="py-2 px-2">
                                    <a href="{{ route('team.show', ['teamId' => $position['team']['id']]) }}" 
                                       class="flex items-center space-x-2 hover:bg-gray-700 rounded px-2 py-1 transition-colors">
                                        <img src="{{ $position['team']['crest'] }}" alt="" class="w-4 h-4">
                                        <span class="text-xs text-gray-200 hover:text-white">{{ $position['team']['name'] }}</span>
                                    </a>
                                </td>
                                <td class="text-center py-2 px-2 text-xs">{{ $position['playedGames'] }}</td>
                                <td class="text-center py-2 px-2 text-xs">{{ $position['won'] }}</td>
                                <td class="text-center py-2 px-2 text-xs">{{ $position['draw'] }}</td>
                                <td class="text-center py-2 px-2 text-xs">{{ $position['lost'] }}</td>
                                <td class="text-center py-2 px-2 text-xs">{{ $position['goalsFor'] }}</td>
                                <td class="text-center py-2 px-2 text-xs">{{ $position['goalsAgainst'] }}</td>
                                <td class="text-center py-2 px-2 text-xs">{{ $position['goalDifference'] }}</td>
                                <td class="text-center py-2 px-2 text-xs font-bold">{{ $position['points'] }}</td>
                                <td class="text-center py-2 px-2">
                                    <div class="flex items-center justify-center gap-[2px]">
                                        @foreach(str_split($position['form'] ?? '') as $result)
                                            @if($result === 'W')
                                                <span class="text-[#3fb54b] text-[11px]">G</span>
                                            @elseif($result === 'D')
                                                <span class="text-[#f3a000] text-[11px]">B</span>
                                            @elseif($result === 'L')
                                                <span class="text-[#d91e00] text-[11px]">M</span>
                                            @endif
                                            @if(!$loop->last)
                                                <span class="text-gray-600 text-[11px] mx-[1px]"> </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Arşiv Tab -->
        <div id="arsiv" class="tab-content hidden">
            <div class="container mx-auto max-w-4xl">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-800">
                            <th class="text-left py-4 px-6 text-sm font-semibold text-gray-400 w-1/2">SEZON</th>
                            <th class="text-left py-4 px-6 text-sm font-semibold text-gray-400 w-1/2">ŞAMPİYON</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($league['seasons'] ?? [] as $season)
                            <tr class="hover:bg-[#1a1f2d] transition-colors border-b border-gray-800/50">
                                <!-- Sezon -->
                                <td class="py-4 px-6">
                                    <span class="text-sm text-white">
                                        {{ $league['name'] }} {{ substr($season['startDate'], 0, 4) }}/{{ substr($season['endDate'], 0, 4) }}
                                    </span>
                                </td>

                                <!-- Şampiyon -->
                                <td class="py-4 px-6">
                                    @if(isset($season['winner']))
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ $season['winner']['crest'] }}" 
                                                 alt="{{ $season['winner']['name'] }}" 
                                                 class="w-4 h-4 object-contain">
                                            <span class="text-sm text-white">{{ $season['winner']['name'] }}</span>
                                        </div>
                                    @else
                                        @if(substr($season['endDate'], 0, 4) > date('Y'))
                                            <span class="text-sm text-gray-500">-</span>
                                        @else
                                            <span class="text-sm text-gray-500">-</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');

    function switchTab(tabId) {
        // Tüm tabları gizle
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });

        // Tüm tab linklerini pasif yap
        tabLinks.forEach(link => {
            link.classList.remove('text-red-500', 'border-b-2', 'border-red-500', 'pb-4');
            link.classList.add('text-gray-400');
        });

        // Seçilen tabı göster
        const selectedTab = document.getElementById(tabId);
        const selectedLink = document.querySelector(`[data-tab="${tabId}"]`);

        if (selectedTab && selectedLink) {
            selectedTab.classList.remove('hidden');
            selectedLink.classList.remove('text-gray-400');
            selectedLink.classList.add('text-red-500', 'border-b-2', 'border-red-500', 'pb-4');
        }
    }

    tabLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const tabId = link.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // Sayfa yüklendiğinde GENEL tabını aç
    switchTab('genel');
});
</script>
@endpush
@endsection 