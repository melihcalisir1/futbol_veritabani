<aside class="w-64 bg-gray-900 shadow-md overflow-y-auto max-h-screen">
    <div class="p-4">
        <h2 class="text-2xl font-bold text-white mb-6 tracking-wide border-b border-gray-700 pb-2">Leagues</h2>
        <nav class="space-y-6">
            <!-- Major Leagues -->
            <div class="mb-6">
                <div class="text-sm text-red-500 mb-3 uppercase font-bold tracking-wider">Major Leagues</div>
                <div class="space-y-2">
                    <a href="{{ route('league.show', 'PL') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'PL' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/39.png" alt="Premier League" class="w-6 h-6 mr-3">
                        Premier League
                    </a>
                    <a href="{{ route('league.show', 'PD') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'PD' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/140.png" alt="La Liga" class="w-6 h-6 mr-3">
                        La Liga
                    </a>
                    <a href="{{ route('league.show', 'BL1') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'BL1' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/78.png" alt="Bundesliga" class="w-6 h-6 mr-3">
                        Bundesliga
                    </a>
                    <a href="{{ route('league.show', 'SA') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'SA' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/135.png" alt="Serie A" class="w-6 h-6 mr-3">
                        Serie A
                    </a>
                    <a href="{{ route('league.show', 'FL1') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'FL1' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/61.png" alt="Ligue 1" class="w-6 h-6 mr-3">
                        Ligue 1
                    </a>
                </div>
            </div>

            <!-- Other Leagues -->
            <div class="mb-6">
                <div class="text-sm text-red-500 mb-3 uppercase font-bold tracking-wider">Other Leagues</div>
                <div class="space-y-2">
                    <a href="{{ route('league.show', 'DED') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'DED' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/88.png" alt="Eredivisie" class="w-6 h-6 mr-3">
                        Eredivisie
                    </a>
                    <a href="{{ route('league.show', 'PPL') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'PPL' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/94.png" alt="Primeira Liga" class="w-6 h-6 mr-3">
                        Primeira Liga
                    </a>
                    <a href="{{ route('league.show', 'ELC') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'ELC' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/40.png" alt="Championship" class="w-6 h-6 mr-3">
                        Championship
                    </a>
                    <a href="{{ route('league.show', 'BSA') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'BSA' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/71.png" alt="Brasileirão" class="w-6 h-6 mr-3">
                        Brasileirão
                    </a>
                </div>
            </div>

            <!-- International -->
            <div>
                <div class="text-sm text-red-500 mb-3 uppercase font-bold tracking-wider">International</div>
                <div class="space-y-2">
                    <a href="{{ route('league.show', 'CL') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'CL' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/2.png" alt="Champions League" class="w-6 h-6 mr-3">
                        Champions League
                    </a>
                    <a href="{{ route('league.show', 'WC') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'WC' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/1.png" alt="World Cup" class="w-6 h-6 mr-3">
                        World Cup
                    </a>
                    <a href="{{ route('league.show', 'EC') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'EC' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/4.png" alt="European Championship" class="w-6 h-6 mr-3">
                        EURO Championship
                    </a>
                    <a href="{{ route('league.show', 'CLI') }}" 
                       class="flex items-center p-2 rounded {{ request()->route('code') === 'CLI' ? 'bg-red-600 text-white font-bold border-l-4 border-red-500' : 'text-white hover:bg-gray-800' }}">
                        <img src="https://media.api-sports.io/football/leagues/13.png" alt="Copa Libertadores" class="w-6 h-6 mr-3">
                        Copa Libertadores
                    </a>
                </div>
            </div>
        </nav>
    </div>
</aside> 