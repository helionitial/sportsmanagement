<?php
require_once "dbconnect.php";

$leaguetype=$_GET["lt"];
$sport=$_GET["sport"];

//$leaguetype="Mens";
//$sport="Basketball";

$sql="SELECT game_id, game_date, game_time, game_location, Team.team_name as team1_name, X.team_name as team2_name, team1_id, team2_id, team1_score, team2_score
FROM `arranges` 
NATURAL JOIN Game
NATURAL JOIN contest NATURAL JOIN League
NATURAL JOIN Team, Team AS X
WHERE Team.team_id = Game.team1_id
AND X.team_id = Game.team2_id AND league_type='".$leaguetype."' AND sport_name='".$sport."'";

$result = mysql_query($sql);

		    echo "<table border='1'>
			<tr>
			
			<th>Game ID</th>
			<th>Date</th>
			<th>Time</th>
			<th>Location</th>
			<th>Team 1</th>
			<th>Team 1 Score</th>
			<th>Team 2 Score</th>
			<th>Team 2</th>
			
			
			

			</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['game_id'] . "</td>";
  echo "<td>" . $row['game_date'] . "</td>";
  echo "<td>" . $row['game_time'] . "</td>";
  echo "<td>" . $row['game_location'] . "</td>";
  echo "<td>" . $row['team1_name'] . "</td>";
  echo "<td>" . $row['team1_score'] . "</td>";
  echo "<td>" . $row['team2_score'] . "</td>";
  echo "<td>" . $row['team2_name'] . "</td>";
  echo "</tr>";
  }
echo "</table>";


?>
