@extends('layouts.app')

@section('title', 'Lig Detayları')

@section('content')
<div class="bg-gray-900 text-white min-h-screen">
    <!-- Sekmeler -->
    <div class="border-b border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex space-x-8 py-4">
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="genel">GENEL</a>
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="sonuclar">SONUÇLAR</a>
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="fikstur">FİKSTÜR</a>
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="puan-durumu">PUAN DURUMU</a>
                <a href="#" class="tab-link text-gray-400 hover:text-white" data-tab="arsiv">ARŞİV</a>
            </div>
        </div>
    </div>

    <!-- Tab İçerikleri -->
    <div class="container mx-auto px-4 py-6">
        <!-- Puan Durumu Tab -->
        <div id="puan-durumu" class="tab-content">
            @if(isset($error))
                <div class="bg-red-600 text-white p-4 mb-4 rounded">
                    {{ $error }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-800">
                            <th class="text-left py-3 px-2">#</th>
                            <th class="text-left py-3 px-2">TAKIM</th>
                            <th class="text-center py-3 px-2">O</th>
                            <th class="text-center py-3 px-2">G</th>
                            <th class="text-center py-3 px-2">B</th>
                            <th class="text-center py-3 px-2">M</th>
                            <th class="text-center py-3 px-2">AG</th>
                            <th class="text-center py-3 px-2">YG</th>
                            <th class="text-center py-3 px-2">AV</th>
                            <th class="text-center py-3 px-2">P</th>
                            <th class="text-center py-3 px-2">FORM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($standings['standings'][0]['table'] ?? [] as $position)
                            <tr class="border-b border-gray-700 hover:bg-gray-800">
                                <td class="py-3 px-2">{{ $position['position'] }}</td>
                                <td class="py-3 px-2">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ $position['team_crest'] }}" alt="" class="w-6 h-6">
                                        <span>{{ $position['team_name'] }}</span>
                                    </div>
                                </td>
                                <td class="text-center py-3 px-2">{{ $position['played_games'] }}</td>
                                <td class="text-center py-3 px-2">{{ $position['won'] }}</td>
                                <td class="text-center py-3 px-2">{{ $position['draw'] }}</td>
                                <td class="text-center py-3 px-2">{{ $position['lost'] }}</td>
                                <td class="text-center py-3 px-2">{{ $position['goals_for'] }}</td>
                                <td class="text-center py-3 px-2">{{ $position['goals_against'] }}</td>
                                <td class="text-center py-3 px-2">{{ $position['goal_difference'] }}</td>
                                <td class="text-center py-3 px-2 font-bold">{{ $position['points'] }}</td>
                                <td class="text-center py-3 px-2">
                                    <div class="flex items-center justify-center gap-[6px]">
                                        @foreach(str_split($position['form'] ?? '') as $result)
                                            @if($result === 'W')
                                                <div class="w-6 h-6 flex items-center justify-center text-white text-xs font-bold rounded-[3px]" 
                                                     style="background-color: rgb(63, 181, 75)">G</div>
                                            @elseif($result === 'D')
                                                <div class="w-6 h-6 flex items-center justify-center text-white text-xs font-bold rounded-[3px]" 
                                                     style="background-color: rgb(243, 160, 0)">B</div>
                                            @elseif($result === 'L')
                                                <div class="w-6 h-6 flex items-center justify-center text-white text-xs font-bold rounded-[3px]" 
                                                     style="background-color: rgb(217, 30, 0)">M</div>
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
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab sistemi için
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');

    tabLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Aktif tab'ı kaldır
            tabLinks.forEach(l => {
                l.classList.remove('text-red-500', 'border-b-2', 'border-red-500', 'pb-4');
                l.classList.add('text-gray-400');
            });

            // Yeni tab'ı aktif et
            link.classList.remove('text-gray-400');
            link.classList.add('text-red-500', 'border-b-2', 'border-red-500', 'pb-4');

            // İçerikleri gizle
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });

            // Seçilen içeriği göster
            const tabId = link.getAttribute('data-tab');
            document.getElementById(tabId).classList.remove('hidden');
        });
    });

    // Sayfa yüklendiğinde puan durumu sekmesini aktif et
    const puanDurumuTab = document.querySelector('[data-tab="puan-durumu"]');
    if (puanDurumuTab) {
        puanDurumuTab.click();
    }
});
</script>
@endpush
@endsection 