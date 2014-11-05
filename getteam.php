<?
include('dbconnect.php');

$headerOptions = array(
  "title" => "View Team"
);
require_once "header.php";


?>


<head>
  <title>View Team</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  
  <script type="text/javascript">
function showRoster(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getroster.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>

<body>
  <div id="main">
    <div id="links"></div>
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="green", allows you to change the colour of the text - other classes are: "blue", "orange", "red", "purple" and "yellow" -->
          <h1>Recreational <span class="green">Sports Management System</span></h1>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          
		  <?php 
			if ($_SESSION['admin'] == '1') {
				  echo "<li><a href='index.php'>Admin Home</a></li>";
				  echo "<li><a href='sports.php'>Sports</a></li>";
				  echo "<li class='selected'><a href='leagues.php'>Leagues</a></li>";
				  echo "<li><a href='game.php'>Game Control</a></li>";
				  echo "<li><a href='logout.php'>Logout</a></li>";
			
			}
			
			else {
				  echo "<li><a href='index.php'>My Teams</a></li>";
				  echo "<li><a href='sports.php'>Create Team</a></li>";
				  echo "<li class='selected'><a href='viewRoster.php'>View Rosters</a></li>";
				  echo "<li><a href='getschedule.php'>Leagues</a></li>";
				  echo "<li><a href='logout.php'>Logout</a></li>";
				}
			
		  ?>

        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        
	
		<?php	
			
			if(isset($_GET["teamname"])) {
			
			//echo "Hello World!";
			
			$teamname=$_GET["teamname"];
			//$teamname="Young Jedi Knights";
				
	
			
			echo "<h1><a href='getschedule.php'>Teams</a> -> " . $teamname . "</h1>";
			echo "<br>";
			echo "<h2>Team Schedule</h2>";
			
			$sql="SELECT game_id, game_date, game_time, game_location, Team.team_name as team1_name, X.team_name as team2_name, team1_id, team2_id, team1_score, team2_score
				FROM `arranges` 
				NATURAL JOIN Game
				NATURAL JOIN contest NATURAL JOIN League
				NATURAL JOIN Team, Team AS X
				WHERE Team.team_id = Game.team1_id
				AND X.team_id = Game.team2_id AND (Team.team_name = '".$teamname."' OR X.team_name = '".$teamname."')";

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
				  $n1 = $row['team1_name'];
				  $n2 = $row['team2_name'];
				  
				  echo "<tr>";
				  echo "<td>" . $row['game_id'] . "</td>";
				  echo "<td>" . $row['game_date'] . "</td>";
				  echo "<td>" . $row['game_time'] . "</td>";
				  echo "<td>" . $row['game_location'] . "</td>";
			      echo "<td>" . "<a href='getteam.php?teamname=".$n1."'>" . $n1 . "</a>" . "</td>";
				  echo "<td>" . $row['team1_score'] . "</td>";
				  echo "<td>" . $row['team2_score'] . "</td>";
				  echo "<td>" . "<a href='getteam.php?teamname=".$n2."'>" . $n2 . "</a>" . "</td>";
				  echo "</tr>";
				  }
				echo "</table>";
			
			
				$sql="SELECT * FROM Team NATURAL JOIN Stats WHERE team_name='".$teamname."'";

				$result = mysql_query($sql);

			
				echo "<table border='1'>
							<tr>
							<th>Team</th>
							<th>Played</th>
							<th>Wins</th>
							<th>Losses</th>
							<th>Draws</th>
							<th>NCS</th>";						
							echo "</tr>";	
							
							
				while($row = mysql_fetch_array($result))
				  {	

										  
					echo "<hr><br><h2>Team Stats</h2>";
				  
				  $played = $row['played'];
				  $wins = $row['wins'];
				  $losses = $row['losses'];
				  $draws = $row['draws'];
				  $ncs = $row['ncs'];
				  
					if ($_SESSION['admin'] == '1') {
				
					  
					  echo "<form method='get' action='editstats.php' id='editForm'>";
					  echo "<tr>";
					      echo "<td>";
						  echo "<input name='tn' type='text' id='tn' value='".$teamname."' size='20' readonly>";
						  echo "</td>";
						  echo "<td>";
						  echo "<input name='played' type='text' id='played' value='".$played."' size='2'>";
						  echo "</td>";
						  echo "<td>";
						  echo "<input name='wins' type='text' id='wins' value='".$wins."' size='2'>";
						  echo "</td>";
						  echo "<td>";
						  echo "<input name='losses' type='text' id='losses' value='".$losses."' size='2'>";
						  echo "</td>";
						  echo "<td>";	  
						  echo "<input name='draws' type='text' id='draws' value='".$draws."' size='2'>";
						  echo "</td>";
						  echo "<td>";
						  echo "<input name='ncs' type='text' id='ncs' value='".$ncs."' size='2'>";
						  echo "</td>";
					  echo "</tr>";
		
					echo "</table>";	
					echo "<input type='submit' name='submit' value='Edit Stats'>";
				 echo "</form>";	
				  }
					else {		
							
				  
				  
				  
				  echo "<tr>";
				  echo "<td>" . $teamname . "</td>";
				  echo "<td>" . $played . "</td>";
				  echo "<td>" . $wins . "</td>";
				  echo "<td>" . $losses . "</td>";
				  echo "<td>" . $draws . "</td>";
				  echo "<td>" . $ncs . "</td>";
				  
				  
				  echo "</tr>";
				  }
				echo "</table>";
				}
		
			
				$sql="CALL TeamRoster('".$teamname."')";

				$result = mysql_query($sql);

				
				echo "<br><br><hr><br>";
				echo "<h2>Roster</h2>";
				echo "<table border='1'>
				<tr>
				<th>User ID</th>
				<th>Firstname</th>
				<th>Lastname</th>";
				if ($_SESSION['admin'] == '1') {
								echo "<th>" . "Action" . "</th>";	
				}
				echo "</tr>";

				echo "<tr>";
				

				
				while($row = mysql_fetch_array($result))
				  {
				  $uid = $row['user_id'];
				  
				  echo "<tr>";
				  echo "<td>" . $uid . "</td>";
				  echo "<td>" . $row['first_name'] . "</td>";
				  echo "<td>" . $row['last_name'] . "</td>";
				  if ($_SESSION['admin'] == '1') {
					echo "<td>" . "<a href='dropplayer.php?tn=".$teamname."&uid=".$uid."'>Drop</a>" . "</td>";	
				  }
				  
				  echo "</tr>";
				  }
				echo "</table>";
			echo "<hr>";
		
				echo "<table border='1'>";
				echo "<tr>";
				echo "<th>Team Name</th>";
				echo "<th>User ID</th>";
			    echo "</tr>";
				
				echo "<form method='get' action='addplayer.php' id='gameForm'>";
				echo "<tr>";
				  echo "<td>";
				  echo "<input name='tn' type='text' id='tn' value='".$teamname."' size='20' readonly>";
				  echo "</td>";
				  echo "<td>";
				  echo "<input name='userid' type='text' id='userid' value='' size='6'>";
				  echo "</td>";
				echo "</tr>";
				echo "<input type='submit' name='submit' value='Add Player'>";
				echo "</form>";
				
						
			}
			
			else {
				/*
				echo "Good Night!";
				
				echo "<form>";
				$t1 = "teams";
				$t2 = "showRoster(this.value)";
				echo "<select name='".$t1."' onchange='".$t2."'>";
				echo "<option value=''>Select a team:</option>";
				
				
			
					$sql = "SELECT * FROM Team ORDER BY team_name";
					$result = mysql_query($sql);
					$dd="";
					while($row = mysql_fetch_assoc($result))
					{
						 $dd .= "<option value='{$row['team_id']}'>{$row['team_name']}</option>";
					} 
					echo $dd;
				
				
				echo "</select>";
				echo "</form>";
				
				*/
				
			}
				
	?>
		
			
		
		
      
      </div>
    <div id="site_content_bottom"></div>
    </div>
  </div>
</body>
</html>

