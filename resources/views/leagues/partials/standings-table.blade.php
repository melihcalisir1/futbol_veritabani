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
    @foreach($standings as $position)
        <tr class="border-b border-gray-700 hover:bg-gray-800">
            <td class="py-3 px-2">{{ $position['position'] }}</td>
            <td class="py-3 px-2">
                <div class="flex items-center space-x-3">
                    <img src="{{ $position['team']['crest'] }}" alt="" class="w-6 h-6">
                    <span>{{ $position['team']['shortName'] ?? $position['team']['name'] }}</span>
                </div>
            </td>
            <td class="text-center py-3 px-2">{{ $position['playedGames'] }}</td>
            <td class="text-center py-3 px-2">{{ $position['won'] }}</td>
            <td class="text-center py-3 px-2">{{ $position['draw'] }}</td>
            <td class="text-center py-3 px-2">{{ $position['lost'] }}</td>
            <td class="text-center py-3 px-2">{{ $position['goalsFor'] }}</td>
            <td class="text-center py-3 px-2">{{ $position['goalsAgainst'] }}</td>
            <td class="text-center py-3 px-2">{{ $position['goalDifference'] }}</td>
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
                        @else
                            <div class="w-6 h-6 flex items-center justify-center bg-gray-700 text-white text-xs font-bold rounded-[3px]">-</div>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>
    @endforeach
</tbody> 