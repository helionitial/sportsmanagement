<?php 
require_once "dbconnect.php";
$query = "SELECT league_type, sport_name, league_id, game_id, game_date, game_time, game_location, team1_id, team2_id, Team.team_name as team1_name, X.team_name as team2_name, team1_score, team2_score FROM `Game` NATURAL JOIN Schedule NATURAL Join League NATURAL JOIN arranges NATURAL JOIN Sport NATURAL JOIN Team, Team as X WHERE Team.team_id = Game.team1_id AND X.team_id = Game.team2_id GROUP BY game_id";
 $sql = mysql_query($query);
 while($row=mysql_fetch_assoc($sql))
{
	$output[]=$row;
	$je = json_encode($output);
	//echo $je;
	$fp = fopen('scoreboard.json', 'w') or die("can't open file");
	fwrite($fp, $je);
	fclose($fp);

}

	mysql_close();
		//  refresh / redirect to an internal web page
	header( 'refresh: 1; url=scoreboard.json' ); # redirects to our homepage
 ?>