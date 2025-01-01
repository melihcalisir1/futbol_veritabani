<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Champion;

class ChampionSeeder extends Seeder
{
    public function run()
    {
        $champions = [
            // Premier League
            ['league_code' => 'PL', 'season_year' => '2023', 'team_name' => 'Manchester City FC', 'team_crest' => 'https://crests.football-data.org/65.png'],
            ['league_code' => 'PL', 'season_year' => '2022', 'team_name' => 'Manchester City FC', 'team_crest' => 'https://crests.football-data.org/65.png'],
            ['league_code' => 'PL', 'season_year' => '2021', 'team_name' => 'Manchester City FC', 'team_crest' => 'https://crests.football-data.org/65.png'],
            ['league_code' => 'PL', 'season_year' => '2020', 'team_name' => 'Manchester City FC', 'team_crest' => 'https://crests.football-data.org/65.png'],
            ['league_code' => 'PL', 'season_year' => '2019', 'team_name' => 'Liverpool FC', 'team_crest' => 'https://crests.football-data.org/64.png'],
            ['league_code' => 'PL', 'season_year' => '2018', 'team_name' => 'Manchester City FC', 'team_crest' => 'https://crests.football-data.org/65.png'],
            ['league_code' => 'PL', 'season_year' => '2017', 'team_name' => 'Chelsea FC', 'team_crest' => 'https://crests.football-data.org/61.png'],
            ['league_code' => 'PL', 'season_year' => '2016', 'team_name' => 'Leicester City FC', 'team_crest' => 'https://crests.football-data.org/338.png'],
            ['league_code' => 'PL', 'season_year' => '2015', 'team_name' => 'Chelsea FC', 'team_crest' => 'https://crests.football-data.org/61.png'],
            ['league_code' => 'PL', 'season_year' => '2014', 'team_name' => 'Manchester City FC', 'team_crest' => 'https://crests.football-data.org/65.png'],
            ['league_code' => 'PL', 'season_year' => '2013', 'team_name' => 'Manchester United FC', 'team_crest' => 'https://crests.football-data.org/66.png'],
            ['league_code' => 'PL', 'season_year' => '2012', 'team_name' => 'Manchester City FC', 'team_crest' => 'https://crests.football-data.org/65.png'],
            ['league_code' => 'PL', 'season_year' => '2011', 'team_name' => 'Manchester United FC', 'team_crest' => 'https://crests.football-data.org/66.png'],
            ['league_code' => 'PL', 'season_year' => '2010', 'team_name' => 'Chelsea FC', 'team_crest' => 'https://crests.football-data.org/61.png'],
            ['league_code' => 'PL', 'season_year' => '2009', 'team_name' => 'Manchester United FC', 'team_crest' => 'https://crests.football-data.org/66.png'],
            ['league_code' => 'PL', 'season_year' => '2008', 'team_name' => 'Manchester United FC', 'team_crest' => 'https://crests.football-data.org/66.png'],
            ['league_code' => 'PL', 'season_year' => '2007', 'team_name' => 'Manchester United FC', 'team_crest' => 'https://crests.football-data.org/66.png'],
            ['league_code' => 'PL', 'season_year' => '2006', 'team_name' => 'Chelsea FC', 'team_crest' => 'https://crests.football-data.org/61.png'],
            ['league_code' => 'PL', 'season_year' => '2005', 'team_name' => 'Chelsea FC', 'team_crest' => 'https://crests.football-data.org/61.png'],
            ['league_code' => 'PL', 'season_year' => '2004', 'team_name' => 'Arsenal FC', 'team_crest' => 'https://crests.football-data.org/57.png'],
            ['league_code' => 'PL', 'season_year' => '2003', 'team_name' => 'Manchester United FC', 'team_crest' => 'https://crests.football-data.org/66.png'],
            ['league_code' => 'PL', 'season_year' => '2002', 'team_name' => 'Arsenal FC', 'team_crest' => 'https://crests.football-data.org/57.png'],
            ['league_code' => 'PL', 'season_year' => '2001', 'team_name' => 'Manchester United FC', 'team_crest' => 'https://crests.football-data.org/66.png'],
            ['league_code' => 'PL', 'season_year' => '2000', 'team_name' => 'Manchester United FC', 'team_crest' => 'https://crests.football-data.org/66.png'],
            // La Liga
            ['league_code' => 'PD', 'season_year' => '2023', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2022', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'PD', 'season_year' => '2021', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'PD', 'season_year' => '2020', 'team_name' => 'Atlético de Madrid', 'team_crest' => 'https://crests.football-data.org/78.png'],
            ['league_code' => 'PD', 'season_year' => '2019', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'PD', 'season_year' => '2018', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2017', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2016', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'PD', 'season_year' => '2015', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2014', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2013', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2012', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'PD', 'season_year' => '2011', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2010', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2009', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2008', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'PD', 'season_year' => '2007', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'PD', 'season_year' => '2006', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2005', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'PD', 'season_year' => '2004', 'team_name' => 'Valencia CF', 'team_crest' => 'https://crests.football-data.org/95.png'],
            ['league_code' => 'PD', 'season_year' => '2003', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'PD', 'season_year' => '2002', 'team_name' => 'Valencia CF', 'team_crest' => 'https://crests.football-data.org/95.png'],
            ['league_code' => 'PD', 'season_year' => '2001', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'PD', 'season_year' => '2000', 'team_name' => 'Deportivo La Coruña', 'team_crest' => 'https://crests.football-data.org/558.png'],
            // Bundesliga
            ['league_code' => 'BL1', 'season_year' => '2023', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2022', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2021', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2020', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2019', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2018', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2017', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2016', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2015', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2014', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2013', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2012', 'team_name' => 'Borussia Dortmund', 'team_crest' => 'https://crests.football-data.org/4.png'],
            ['league_code' => 'BL1', 'season_year' => '2011', 'team_name' => 'Borussia Dortmund', 'team_crest' => 'https://crests.football-data.org/4.png'],
            ['league_code' => 'BL1', 'season_year' => '2010', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2009', 'team_name' => 'VfL Wolfsburg', 'team_crest' => 'https://crests.football-data.org/11.png'],
            ['league_code' => 'BL1', 'season_year' => '2008', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2007', 'team_name' => 'VfB Stuttgart', 'team_crest' => 'https://crests.football-data.org/10.png'],
            ['league_code' => 'BL1', 'season_year' => '2006', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2005', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2004', 'team_name' => 'Werder Bremen', 'team_crest' => 'https://crests.football-data.org/12.png'],
            ['league_code' => 'BL1', 'season_year' => '2003', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2002', 'team_name' => 'Borussia Dortmund', 'team_crest' => 'https://crests.football-data.org/4.png'],
            ['league_code' => 'BL1', 'season_year' => '2001', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'BL1', 'season_year' => '2000', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            // Serie A
            ['league_code' => 'SA', 'season_year' => '2023', 'team_name' => 'SSC Napoli', 'team_crest' => 'https://crests.football-data.org/113.png'],
            ['league_code' => 'SA', 'season_year' => '2022', 'team_name' => 'AC Milan', 'team_crest' => 'https://crests.football-data.org/98.png'],
            ['league_code' => 'SA', 'season_year' => '2021', 'team_name' => 'FC Internazionale Milano', 'team_crest' => 'https://crests.football-data.org/108.png'],
            ['league_code' => 'SA', 'season_year' => '2020', 'team_name' => 'FC Internazionale Milano', 'team_crest' => 'https://crests.football-data.org/108.png'],
            ['league_code' => 'SA', 'season_year' => '2019', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2018', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2017', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2016', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2015', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2014', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2013', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2012', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2011', 'team_name' => 'AC Milan', 'team_crest' => 'https://crests.football-data.org/98.png'],
            ['league_code' => 'SA', 'season_year' => '2010', 'team_name' => 'FC Internazionale Milano', 'team_crest' => 'https://crests.football-data.org/108.png'],
            ['league_code' => 'SA', 'season_year' => '2009', 'team_name' => 'FC Internazionale Milano', 'team_crest' => 'https://crests.football-data.org/108.png'],
            ['league_code' => 'SA', 'season_year' => '2008', 'team_name' => 'FC Internazionale Milano', 'team_crest' => 'https://crests.football-data.org/108.png'],
            ['league_code' => 'SA', 'season_year' => '2007', 'team_name' => 'FC Internazionale Milano', 'team_crest' => 'https://crests.football-data.org/108.png'],
            ['league_code' => 'SA', 'season_year' => '2006', 'team_name' => 'FC Internazionale Milano', 'team_crest' => 'https://crests.football-data.org/108.png'],
            ['league_code' => 'SA', 'season_year' => '2005', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2004', 'team_name' => 'AC Milan', 'team_crest' => 'https://crests.football-data.org/98.png'],
            ['league_code' => 'SA', 'season_year' => '2003', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2002', 'team_name' => 'Juventus FC', 'team_crest' => 'https://crests.football-data.org/109.png'],
            ['league_code' => 'SA', 'season_year' => '2001', 'team_name' => 'AS Roma', 'team_crest' => 'https://crests.football-data.org/100.png'],
            ['league_code' => 'SA', 'season_year' => '2000', 'team_name' => 'Lazio', 'team_crest' => 'https://crests.football-data.org/110.png'],
            // Ligue 1
            ['league_code' => 'FL1', 'season_year' => '2023', 'team_name' => 'Paris Saint-Germain', 'team_crest' => 'https://crests.football-data.org/524.png'],
            ['league_code' => 'FL1', 'season_year' => '2022', 'team_name' => 'Paris Saint-Germain', 'team_crest' => 'https://crests.football-data.org/524.png'],
            ['league_code' => 'FL1', 'season_year' => '2021', 'team_name' => 'LOSC Lille', 'team_crest' => 'https://crests.football-data.org/521.png'],
            ['league_code' => 'FL1', 'season_year' => '2020', 'team_name' => 'Paris Saint-Germain', 'team_crest' => 'https://crests.football-data.org/524.png'],
            ['league_code' => 'FL1', 'season_year' => '2019', 'team_name' => 'Paris Saint-Germain', 'team_crest' => 'https://crests.football-data.org/524.png'],
            ['league_code' => 'FL1', 'season_year' => '2018', 'team_name' => 'Paris Saint-Germain', 'team_crest' => 'https://crests.football-data.org/524.png'],
            ['league_code' => 'FL1', 'season_year' => '2017', 'team_name' => 'AS Monaco', 'team_crest' => 'https://crests.football-data.org/514.png'],
            ['league_code' => 'FL1', 'season_year' => '2016', 'team_name' => 'Paris Saint-Germain', 'team_crest' => 'https://crests.football-data.org/524.png'],
            ['league_code' => 'FL1', 'season_year' => '2015', 'team_name' => 'Paris Saint-Germain', 'team_crest' => 'https://crests.football-data.org/524.png'],
            ['league_code' => 'FL1', 'season_year' => '2014', 'team_name' => 'Paris Saint-Germain', 'team_crest' => 'https://crests.football-data.org/524.png'],
            ['league_code' => 'FL1', 'season_year' => '2013', 'team_name' => 'Paris Saint-Germain', 'team_crest' => 'https://crests.football-data.org/524.png'],
            ['league_code' => 'FL1', 'season_year' => '2012', 'team_name' => 'Montpellier HSC', 'team_crest' => 'https://crests.football-data.org/518.png'],
            ['league_code' => 'FL1', 'season_year' => '2011', 'team_name' => 'LOSC Lille', 'team_crest' => 'https://crests.football-data.org/521.png'],
            ['league_code' => 'FL1', 'season_year' => '2010', 'team_name' => 'Olympique Marseille', 'team_crest' => 'https://crests.football-data.org/516.png'],
            ['league_code' => 'FL1', 'season_year' => '2009', 'team_name' => 'Girondins Bordeaux', 'team_crest' => 'https://crests.football-data.org/512.png'],
            ['league_code' => 'FL1', 'season_year' => '2008', 'team_name' => 'Olympique Lyon', 'team_crest' => 'https://crests.football-data.org/523.png'],
            ['league_code' => 'FL1', 'season_year' => '2007', 'team_name' => 'Olympique Lyon', 'team_crest' => 'https://crests.football-data.org/523.png'],
            ['league_code' => 'FL1', 'season_year' => '2006', 'team_name' => 'Olympique Lyon', 'team_crest' => 'https://crests.football-data.org/523.png'],
            ['league_code' => 'FL1', 'season_year' => '2005', 'team_name' => 'Olympique Lyon', 'team_crest' => 'https://crests.football-data.org/523.png'],
            ['league_code' => 'FL1', 'season_year' => '2004', 'team_name' => 'Olympique Lyon', 'team_crest' => 'https://crests.football-data.org/523.png'],
            ['league_code' => 'FL1', 'season_year' => '2003', 'team_name' => 'Olympique Lyon', 'team_crest' => 'https://crests.football-data.org/523.png'],
            ['league_code' => 'FL1', 'season_year' => '2002', 'team_name' => 'Olympique Lyon', 'team_crest' => 'https://crests.football-data.org/523.png'],
            ['league_code' => 'FL1', 'season_year' => '2001', 'team_name' => 'FC Nantes', 'team_crest' => 'https://crests.football-data.org/543.png'],
            ['league_code' => 'FL1', 'season_year' => '2000', 'team_name' => 'AS Monaco', 'team_crest' => 'https://crests.football-data.org/514.png'],
            // Eredivisie
            ['league_code' => 'DED', 'season_year' => '2023', 'team_name' => 'Feyenoord', 'team_crest' => 'https://crests.football-data.org/675.png'],
            ['league_code' => 'DED', 'season_year' => '2022', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2021', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2020', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2019', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2018', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            ['league_code' => 'DED', 'season_year' => '2017', 'team_name' => 'Feyenoord', 'team_crest' => 'https://crests.football-data.org/675.png'],
            ['league_code' => 'DED', 'season_year' => '2016', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            ['league_code' => 'DED', 'season_year' => '2015', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            ['league_code' => 'DED', 'season_year' => '2014', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2013', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2012', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2011', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2010', 'team_name' => 'FC Twente', 'team_crest' => 'https://crests.football-data.org/677.png'],
            ['league_code' => 'DED', 'season_year' => '2009', 'team_name' => 'AZ Alkmaar', 'team_crest' => 'https://crests.football-data.org/682.png'],
            ['league_code' => 'DED', 'season_year' => '2008', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            ['league_code' => 'DED', 'season_year' => '2007', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            ['league_code' => 'DED', 'season_year' => '2006', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            ['league_code' => 'DED', 'season_year' => '2005', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            ['league_code' => 'DED', 'season_year' => '2004', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2003', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            ['league_code' => 'DED', 'season_year' => '2002', 'team_name' => 'Ajax', 'team_crest' => 'https://crests.football-data.org/678.png'],
            ['league_code' => 'DED', 'season_year' => '2001', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            ['league_code' => 'DED', 'season_year' => '2000', 'team_name' => 'PSV Eindhoven', 'team_crest' => 'https://crests.football-data.org/674.png'],
            // Primeira Liga
            ['league_code' => 'PPL', 'season_year' => '2023', 'team_name' => 'Benfica', 'team_crest' => 'https://crests.football-data.org/1903.png'],
            ['league_code' => 'PPL', 'season_year' => '2022', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2021', 'team_name' => 'Sporting CP', 'team_crest' => 'https://crests.football-data.org/498.png'],
            ['league_code' => 'PPL', 'season_year' => '2020', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2019', 'team_name' => 'Benfica', 'team_crest' => 'https://crests.football-data.org/1903.png'],
            ['league_code' => 'PPL', 'season_year' => '2018', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2017', 'team_name' => 'Benfica', 'team_crest' => 'https://crests.football-data.org/1903.png'],
            ['league_code' => 'PPL', 'season_year' => '2016', 'team_name' => 'Benfica', 'team_crest' => 'https://crests.football-data.org/1903.png'],
            ['league_code' => 'PPL', 'season_year' => '2015', 'team_name' => 'Benfica', 'team_crest' => 'https://crests.football-data.org/1903.png'],
            ['league_code' => 'PPL', 'season_year' => '2014', 'team_name' => 'Benfica', 'team_crest' => 'https://crests.football-data.org/1903.png'],
            ['league_code' => 'PPL', 'season_year' => '2013', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2012', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2011', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2010', 'team_name' => 'Benfica', 'team_crest' => 'https://crests.football-data.org/1903.png'],
            ['league_code' => 'PPL', 'season_year' => '2009', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2008', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2007', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2006', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2005', 'team_name' => 'Benfica', 'team_crest' => 'https://crests.football-data.org/1903.png'],
            ['league_code' => 'PPL', 'season_year' => '2004', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2003', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'PPL', 'season_year' => '2002', 'team_name' => 'Sporting CP', 'team_crest' => 'https://crests.football-data.org/498.png'],
            ['league_code' => 'PPL', 'season_year' => '2001', 'team_name' => 'Boavista FC', 'team_crest' => 'https://crests.football-data.org/810.png'],
            ['league_code' => 'PPL', 'season_year' => '2000', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            // Champions League
            ['league_code' => 'CL', 'season_year' => '2023', 'team_name' => 'Manchester City FC', 'team_crest' => 'https://crests.football-data.org/65.png'],
            ['league_code' => 'CL', 'season_year' => '2022', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'CL', 'season_year' => '2021', 'team_name' => 'Chelsea FC', 'team_crest' => 'https://crests.football-data.org/61.png'],
            ['league_code' => 'CL', 'season_year' => '2020', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'CL', 'season_year' => '2019', 'team_name' => 'Liverpool FC', 'team_crest' => 'https://crests.football-data.org/64.png'],
            ['league_code' => 'CL', 'season_year' => '2018', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'CL', 'season_year' => '2017', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'CL', 'season_year' => '2016', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'CL', 'season_year' => '2015', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'CL', 'season_year' => '2014', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'CL', 'season_year' => '2013', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'CL', 'season_year' => '2012', 'team_name' => 'Chelsea FC', 'team_crest' => 'https://crests.football-data.org/61.png'],
            ['league_code' => 'CL', 'season_year' => '2011', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'CL', 'season_year' => '2010', 'team_name' => 'FC Internazionale Milano', 'team_crest' => 'https://crests.football-data.org/108.png'],
            ['league_code' => 'CL', 'season_year' => '2009', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'CL', 'season_year' => '2008', 'team_name' => 'Manchester United FC', 'team_crest' => 'https://crests.football-data.org/66.png'],
            ['league_code' => 'CL', 'season_year' => '2007', 'team_name' => 'AC Milan', 'team_crest' => 'https://crests.football-data.org/98.png'],
            ['league_code' => 'CL', 'season_year' => '2006', 'team_name' => 'FC Barcelona', 'team_crest' => 'https://crests.football-data.org/81.png'],
            ['league_code' => 'CL', 'season_year' => '2005', 'team_name' => 'Liverpool FC', 'team_crest' => 'https://crests.football-data.org/64.png'],
            ['league_code' => 'CL', 'season_year' => '2004', 'team_name' => 'FC Porto', 'team_crest' => 'https://crests.football-data.org/503.png'],
            ['league_code' => 'CL', 'season_year' => '2003', 'team_name' => 'AC Milan', 'team_crest' => 'https://crests.football-data.org/98.png'],
            ['league_code' => 'CL', 'season_year' => '2002', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            ['league_code' => 'CL', 'season_year' => '2001', 'team_name' => 'Bayern München', 'team_crest' => 'https://crests.football-data.org/5.png'],
            ['league_code' => 'CL', 'season_year' => '2000', 'team_name' => 'Real Madrid CF', 'team_crest' => 'https://crests.football-data.org/86.png'],
            // European Championship
            ['league_code' => 'EC', 'season_year' => '2020', 'team_name' => 'Italy', 'team_crest' => 'https://crests.football-data.org/784.png'],
            ['league_code' => 'EC', 'season_year' => '2016', 'team_name' => 'Portugal', 'team_crest' => 'https://crests.football-data.org/765.png'],
            ['league_code' => 'EC', 'season_year' => '2012', 'team_name' => 'Spain', 'team_crest' => 'https://crests.football-data.org/760.png'],
            ['league_code' => 'EC', 'season_year' => '2008', 'team_name' => 'Spain', 'team_crest' => 'https://crests.football-data.org/760.png'],
            ['league_code' => 'EC', 'season_year' => '2004', 'team_name' => 'Greece', 'team_crest' => 'https://crests.football-data.org/775.png'],
            ['league_code' => 'EC', 'season_year' => '2000', 'team_name' => 'France', 'team_crest' => 'https://crests.football-data.org/773.png'],

            // World Cup
            ['league_code' => 'WC', 'season_year' => '2022', 'team_name' => 'Argentina', 'team_crest' => 'https://crests.football-data.org/762.png'],
            ['league_code' => 'WC', 'season_year' => '2018', 'team_name' => 'France', 'team_crest' => 'https://crests.football-data.org/773.png'],
            ['league_code' => 'WC', 'season_year' => '2014', 'team_name' => 'Germany', 'team_crest' => 'https://crests.football-data.org/759.png'],
            ['league_code' => 'WC', 'season_year' => '2010', 'team_name' => 'Spain', 'team_crest' => 'https://crests.football-data.org/760.png'],
            ['league_code' => 'WC', 'season_year' => '2006', 'team_name' => 'Italy', 'team_crest' => 'https://crests.football-data.org/784.png'],
            ['league_code' => 'WC', 'season_year' => '2002', 'team_name' => 'Brazil', 'team_crest' => 'https://crests.football-data.org/764.png']
        ];

        foreach ($champions as $champion) {
            Champion::create($champion);
        }
    }
} 