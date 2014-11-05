<?
include('dbconnect.php');
$headerOptions = array(
  "title" => "Game Control"
);

/*
if(isset($_SESSION["user"])) {
	header("Location: myTeams.php");
	exit; 	// ensure script terminates immediately
}
else{
	header("Location: login.php");
	exit;
}*/

require_once "header.php";


?>


<head>
  <title>Game Control</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  

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
          <li><a href="index.php">Admin Home</a></li>
		  <li><a href="sports.php">Sports</a></li>
		  <li><a href="leagues.php">Leagues</a></li>
  		  <li class="selected"><a href="game.php">Game Control</a></li>
          <li><a href="logout.php">Logout</a></li>

        </ul>
      </div>
    </div>
    <div id="site_content">
<!--
	<div class="sidebar">
        
        <p>Welcome back <b><?php echo $_SESSION['user']; ?></b>!</p>
		<p>Today is <?php echo(gmdate("l dS \of F Y h:i:s A") . "<br />"); ?></p> 
		<h1>Latest News</h1>
        <h2>New Website Launched</h2>
        <h3>January 1st, 2010</h3>
        <p>2010 sees the redesign of our website. Take a look around and let us know what you think.<br /><a href="#">Read more</a></p>
        <h1>Useful Links</h1>
        <ul>
          <li><a href="#">link 1</a></li>
          <li><a href="#">link 2</a></li>
          <li><a href="#">link 3</a></li>
          <li><a href="#">link 4</a></li>
        </ul>
        <h1>Useful Info</h1>
        <p>You can put anything you like in the sidebar. Latest news, useful links, images, contact information. Anything you think the visitor will find useful.</p>
      </div>
-->	  

	<?php
	
	
	
	?>


      <div id="content">
        <!-- insert the page content here -->
        <h1>Game Control</h1>

		
		<form method="get" action="game.php" id="teamForm">
       			
			<label for="typeInput">League Type:</label>
            <select name="leaguetype" id="leaguetype">
			<option value="">-----------------------------</option>
			<option value="Mens">Mens</option>
			<option value="Womens">Womens</option>
			<option value="Corec">Co-rec</option>
			</select><br />
			<br>
					
			<label for ="sportInput">Sport:</label>
			<select id="sportInput" name="sport">
			<option value="">-----------------------------</option>
			<?
				$sql = "SELECT sport_name FROM Sport";
				$result = mysql_query($sql);
				$dd="";
				while($row = mysql_fetch_assoc($result))
				{
					$dd .= "<option value='{$row['sport_name']}'>{$row['sport_name']}</option>";
				} 
				echo $dd;
			?>
			</select><br><br>
			<input type="submit" name="submit" value="Set League">
		</form>
		
		<br><br><hr><br><br>
		
		<?php
		
			if (isset($_GET['lt'], $_GET['sp'], $_GET['i'], $_GET['d'], $_GET['t'], $_GET['l'], $_GET['n1'], $_GET['n2'], $_GET['s1'], $_GET['s2'])) {
				  //echo $_GET['n1'];
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
				  
				  echo "<form method='get' action='editgame.php' id='editForm'>";
				  echo "<tr>";
				  echo "<td>";
				  echo "<input name='gameid' type='text' id='gameid' value='".$_GET['i']."' size='2'>";
				  echo "</td>";
				  echo "<td>";
				  echo "<input name='date' type='text' id='date' value='".$_GET['d']."' size='6'>";
				  echo "</td>";
				  echo "<td>";
				  echo "<input name='time' type='text' id='time' value='".$_GET['t']."' size='5'>";
				  echo "</td>";
		 
				  echo "<td>" . "<input id='loc' name='loc' type ='text' value='".$_GET['l']."' size='9'/>" . "</td>";
				  echo "<td>";
						echo "<select id='team1Input' name='team1' value='".$_GET['n1']."'>";
						$sql="SELECT team_id FROM Team WHERE team_name='".$_GET['n1']."';";
					    $result = mysql_query($sql);
					    $team_id = mysql_result($result, 0);
						echo "<option value='".$team_id."'>".$_GET['n1']."</option>";
						$sql = "SELECT * FROM Team NATURAL JOIN contest NATURAL JOIN League WHERE league_type='".$_GET['lt']."' AND sport_name='".$_GET['sp']."'";
						$result = mysql_query($sql);
						$dd="";
						while($row = mysql_fetch_assoc($result))
						{
							 $dd .= "<option value='{$row['team_id']}'> {$row['team_name']}</option>";
						} 
						echo $dd;
						echo "</select>";
			
				  echo "</td>";
				  
				  echo "<td>";
				  echo "<input name='s1' type='text' id='s1' value='".$_GET['s1']."' size='5'>";
				  echo "</td>";
				  
				  echo "<td>";
				  echo "<input name='s2' type='text' id='s2' value='".$_GET['s2']."' size='5'>";
				  echo "</td>";
				  
				  echo "<td>";
						echo "<select id='team2Input' name='team2' value='".$_GET['n2']."'>";
						$sql="SELECT team_id FROM Team WHERE team_name='".$_GET['n2']."';";
					    $result = mysql_query($sql);
					    $team_id = mysql_result($result, 0);
						echo "<option value='".$team_id."'>".$_GET['n2']."</option>";
						$sql = "SELECT * FROM Team NATURAL JOIN contest NATURAL JOIN League WHERE league_type='".$_GET['lt']."' AND sport_name='".$_GET['sp']."'";
						$result = mysql_query($sql);
						$dd="";
						while($row = mysql_fetch_assoc($result))
						{
							 $dd .= "<option value='{$row['team_id']}'> {$row['team_name']}</option>";
						} 
						echo $dd;
						echo "</select>";
					
				  echo "</td>";
				echo "</tr>";
	
				echo "</table>";

				 echo "<input type='submit' name='submit' value='Edit Game'>";
				 echo "</form>";		
					
			}
			
		?>
		
		
		
		<?php

/*
<?php //Check to see if a date has been posted
if(isset($_POST['date'])){
$mysql_date = date('Y-m-d G:i:s',strtotime($_POST['date'] . $_POST['time'] . $_POST['ampm']));
}
?>
*/
if (isset($_GET['leaguetype'], $_GET['sport'])) {

		  $leaguetype = $_GET['leaguetype'];
		  $sport = $_GET['sport'];	
	// -------------------------------
	
	
			echo "<table border='1'>
				<tr>
				<th>League Type</th>
				<th>Sport</th>
				<th>Date</th>
				<th>Time</th>
				
				<th>Location</th>
				<th>Team 1</th>
				<th>Team 2</th>
				</tr>";

			//ADD TEAM _____________________________________________
				
				echo "<h2>Add Game</h2>";
			
				echo "<form method='get' action='addgame.php' id='gameForm'>";
				echo "<tr>";
				  echo "<td>";
				  echo "<input name='leaguetype' type='text' id='leaguetype' value='".$leaguetype."' size='6'>";
				  echo "</td>";
				  echo "<td>";
				  echo "<input name='sport' type='text' id='sport' value='".$sport."' size='6'>";
				  echo "</td>";				
				  echo "<td>";
				  echo "<input name='date' type='text' id='date' value='' size='6'>";
				  echo "</td>";
				  echo "<td>";
				  echo "<input name='time' type='text' id='time' value='' size='6'>";
				  echo "</td>";
     			  echo "<td>" . "<input id='loc' name='loc' type ='text' value='' size='10'/>" . "</td>";
				  echo "<td>";
						echo "<select id='team1Input' name='team1'>";
						echo "<option value=''>---</option>";
						//$sql = "SELECT * FROM Team NATURAL JOIN contest NATURAL JOIN League WHERE league_id = '111'";
						$sql = "SELECT * FROM Team NATURAL JOIN contest NATURAL JOIN League WHERE league_type = '" . $leaguetype . "' AND sport_name = '" .$sport ."'";
						$result = mysql_query($sql);
						$dd="";
						while($row = mysql_fetch_assoc($result))
						{
							 $dd .= "<option value='{$row['team_id']}'> {$row['team_name']}</option>";
						} 
						echo $dd;
						echo "</select>";
			
				  echo "</td>";
				  echo "<td>";
						echo "<select id='team2Input' name='team2'>";
						echo "<option value=''>---</option>";
						$sql = "SELECT * FROM Team NATURAL JOIN contest NATURAL JOIN League WHERE league_type = '" . $leaguetype . "' AND sport_name = '" .$sport ."'";
						$result = mysql_query($sql);
						$dd="";
						while($row = mysql_fetch_assoc($result))
						{
							 $dd .= "<option value='{$row['team_id']}'> {$row['team_name']}</option>";
						} 
						echo $dd;
						echo "</select>";
					
				  echo "</td>";
				echo "</tr>";
	
				echo "</table>";

				 echo "<input type='submit' name='submit' value='Add Game'>";
				 echo "</form>";		

				 echo "<br><br><br><hr><br><br>";
			
			
	// --------------------------------
			echo "<h2>" . "Team Schedule:" . " " . $leaguetype . " " . $sport . "</h2>";
		  
		$sql="SELECT game_id, game_date, game_time, game_location, Team.team_name as team1_name, X.team_name as team2_name, team1_score, team2_score
		FROM League NATURAL JOIN `arranges` 
		NATURAL JOIN Game
		NATURAL JOIN contest
		NATURAL JOIN Team, Team AS X
		WHERE Team.team_id = Game.team1_id
		AND X.team_id = Game.team2_id AND sport_name='".$sport."' AND league_type='" .$leaguetype."' ORDER BY game_id";
		
		 $result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
		 $league = mysql_fetch_row($result);	
		 $row = mysql_fetch_array($result);
		 
		 echo "<table border='1'>
			<tr>
			<th>Game ID</th>
			<th>Game Date</th>
			<th>Game Time</th>
			<th>Game Location</th>
			<th>Team 1</th>
			<th>Team 1 Score</th>
			<th>Team 2 Score</th>
			<th>Team 2</th>			
			<th>Action</th>
			</tr>";

			while($row = mysql_fetch_array($result))
			  {
			  
			  $gid= $row['game_id'];
			  $gd = $row['game_date'];
			  $gt = $row['game_time'];
			  $gl = $row['game_location'];
			  $n1 = $row['team1_name'];
			  $n2 = $row['team2_name'];
			  $s1 = $row['team1_score'];
			  $s2 = $row['team2_score'];
			  
			  echo "<tr>";
			  echo "<td>" . $gid. "</td>";
			  echo "<td>" . $gd . "</td>";
			  echo "<td>" . $gt . "</td>";
			  echo "<td>" . $gl . "</td>";
			  echo "<td>" . "<a href='getteam.php?teamname=".$n1."'>" . $n1 . "</a>" . "</td>";
			  echo "<td>" . $s1 . "</td>";
			  echo "<td>" . $s2 . "</td>";
			  echo "<td>" . "<a href='getteam.php?teamname=".$n2."'>" . $n2 . "</a>" . "</td>";
			  echo "<td>" . "<a href='game.php?lt=".$leaguetype."&sp=".$sport."&i=".$gid."&d=".$gd."&t=".$gt."&l=".$gl."&n1=".$n1."&n2=".$n2."&s1=".$s1."&s2=".$s2."'>Edit</a> / 
			  <a href='deletegame.php?date=".$gd."&time=".$gt."&loc=".$gl."'>Delete</a>" . "</td>";
			  echo "</tr>";
			  }
				echo "</table>";
				
// ------------------------------------------------------------------


 

 }
		
		
		
		?>

		
		
		
		
      </div>
    <div id="site_content_bottom"></div>
    </div>
  </div>
</body>
</html>

