	<?php		require_once "dbconnect.php";	
	$error = false;
	/* Ensure all form variables (teamname and league) are set */
	if (isset($_POST['teamname'], $_POST['league']))
	{
	  $teamname = $_POST['teamname'];
	  $league = $_POST['league'];	
	  $captain = $_SESSION['user'];
	  
	  $leaguedata = explode(" ", $league);
	  $leaguetype = $leaguedata[0];
	  $sport = $leaguedata[1];
	  
	  echo "Teamname: " . $teamname;	  echo "<br>";	  echo "Error? " . $error;	  echo "<br>";
  
	  if ($error === false)
	  {
		// query database to see if teamname is already in use
		// INSERT CODE HERE <-------------------------------------------------------
		$sql = "SELECT team_id FROM Team WHERE team_name = '".$teamname."';";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error()); s;
		  echo "result: " . $result;  echo "<br>";	  echo "Error? " . $error;	  echo "<br>";		
		if (mysql_num_rows($result) > 0)
		  //echo mysql_num_rows($result);
		  $error = "Team name already registered";
	  }

	  if ($error === false)
	  {
		// insert user into database
		// INSERT CODE HERE <-------------------------------------------------------
		$sql = "INSERT INTO Team (team_name, captain) VALUES ('".$_POST['teamname']."', '".$_SESSION['user']."');";
		$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error()); ;
		
	  echo "Error? " . $error;	  echo "<br>";		
		if ($result !== false)
		{
		  $sql2 = "SELECT team_id FROM Team WHERE team_name='".$teamname."'";
		  $teamid=mysql_query($sql2);
		  $sql3 = "SELECT league_id FROM League WHERE league_type='".$leaguetype."' AND sport_name='".$sport."'";
		  $leagueid=mysql_query($sql3);
		  
		  $sql4 = "INSERT INTO contest (team_id, league_id) VALUES ('".$teamid."', '".$leagueid."')";
		  $result = mysql_query($sql4);
		  
		  // redirect to index
		  header("Location: index.php");
		  exit; 	// ensure script terminates immediately 
		}
		else
		{
		  $error = "We're sorry, but an unexpected error prevented us from ".
			  "finalizing your registration.";
		  // DEBUGGING ONLY !!! REMOVE AFTER HAND TESTING!
		  $error = mysql_error(); // retrieve error message from server
		}
		 
	  }
	  

	}
	
	
	else if (! empty($_POST))
		echo "missing required info!";	//	  $error = "Missing required information";

	 ?> 