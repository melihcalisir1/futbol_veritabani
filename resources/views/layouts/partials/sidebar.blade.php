<aside class="w-64 bg-white shadow-md">
    <div class="p-4">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Popular Leagues</h2>
        <nav class="space-y-2">
            <a href="{{ route('league.show', 'PL') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                <img src="/images/leagues/premier-league.png" alt="Premier League" class="w-6 h-6 mr-3">
                Premier League
            </a>
            <a href="{{ route('league.show', 'PD') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                <img src="/images/leagues/la-liga.png" alt="La Liga" class="w-6 h-6 mr-3">
                La Liga
            </a>
            <a href="{{ route('league.show', 'BL1') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                <img src="/images/leagues/bundesliga.png" alt="Bundesliga" class="w-6 h-6 mr-3">
                Bundesliga
            </a>
            <a href="{{ route('league.show', 'SA') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                <img src="/images/leagues/serie-a.png" alt="Serie A" class="w-6 h-6 mr-3">
                Serie A
            </a>
            <a href="{{ route('league.show', 'FL1') }}" class="flex items-center p-2 hover:bg-gray-100 rounded">
                <img src="/images/leagues/ligue-1.png" alt="Ligue 1" class="w-6 h-6 mr-3">
                Ligue 1
            </a>
        </nav>
    </div>
</aside> 