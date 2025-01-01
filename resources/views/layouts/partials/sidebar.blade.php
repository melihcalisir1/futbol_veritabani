<aside class="w-64 bg-white shadow-md overflow-y-auto max-h-screen">
    <div class="p-4">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Leagues</h2>
        <nav class="space-y-2">
            <!-- Major Leagues -->
            <div class="mb-4">
                <div class="text-xs text-gray-500 mb-2 uppercase">Major Leagues</div>
                <div class="space-y-1">
                    <a href="{{ route('league.show', 'PL') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/39.png" alt="Premier League" class="w-6 h-6 mr-3">
                        Premier League
                    </a>
                    <a href="{{ route('league.show', 'PD') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/140.png" alt="La Liga" class="w-6 h-6 mr-3">
                        La Liga
                    </a>
                    <a href="{{ route('league.show', 'BL1') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/78.png" alt="Bundesliga" class="w-6 h-6 mr-3">
                        Bundesliga
                    </a>
                    <a href="{{ route('league.show', 'SA') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/135.png" alt="Serie A" class="w-6 h-6 mr-3">
                        Serie A
                    </a>
                    <a href="{{ route('league.show', 'FL1') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/61.png" alt="Ligue 1" class="w-6 h-6 mr-3">
                        Ligue 1
                    </a>
                </div>
            </div>

            <!-- Other Leagues -->
            <div class="mb-4">
                <div class="text-xs text-gray-500 mb-2 uppercase">Other Leagues</div>
                <div class="space-y-1">
                    <a href="{{ route('league.show', 'DED') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/88.png" alt="Eredivisie" class="w-6 h-6 mr-3">
                        Eredivisie
                    </a>
                    <a href="{{ route('league.show', 'PPL') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/94.png" alt="Primeira Liga" class="w-6 h-6 mr-3">
                        Primeira Liga
                    </a>
                    <a href="{{ route('league.show', 'ELC') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/40.png" alt="Championship" class="w-6 h-6 mr-3">
                        Championship
                    </a>
                    <a href="{{ route('league.show', 'BSA') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/71.png" alt="Brasileirão" class="w-6 h-6 mr-3">
                        Brasileirão
                    </a>
                </div>
            </div>

            <!-- International -->
            <div>
                <div class="text-xs text-gray-500 mb-2 uppercase">International</div>
                <div class="space-y-1">
                    <a href="{{ route('league.show', 'CL') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/2.png" alt="Champions League" class="w-6 h-6 mr-3">
                        Champions League
                    </a>
                    <a href="{{ route('league.show', 'WC') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/1.png" alt="World Cup" class="w-6 h-6 mr-3">
                        World Cup
                    </a>
                    <a href="{{ route('league.show', 'EC') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/4.png" alt="European Championship" class="w-6 h-6 mr-3">
                        EURO Championship
                    </a>
                    <a href="{{ route('league.show', 'CLI') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                        <img src="https://media.api-sports.io/football/leagues/13.png" alt="Copa Libertadores" class="w-6 h-6 mr-3">
                        Copa Libertadores
                    </a>
                </div>
            </div>
        </nav>
    </div>
</aside> 