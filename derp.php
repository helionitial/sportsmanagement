<?php
include('dbconnect.php');
$headerOptions = array(
  "title" => "Derp"
);
require_once "header.php";
?>
<head>
  <title>simple_square template</title>
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
          <h1>Recreational<span class="green">Sports Management System</span></h1>
          <h2>your gateway to IM Sports</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.php">Admin Home</a></li>
		  <li class="selected"><a href="game.php">Game</a></li>
          <li><a href="viewRoster.php">View Rosters</a></li>
          <li><a href="getschedule.php">Leagues</a></li>
          <li><a href="logout.php">Logout</a></li>
		  -->
        </ul>
      </div>
    </div>
    <div id="site_content">
	  <div id="content">
        <!-- insert the page content here -->
        <h1>Derp Control</h1>
<?				
               $sql="SELECT team_id FROM Team WHERE team_name='Young Jedi Knights';";
			   $result = mysql_query($sql);
			   $team_id = mysql_result($result, 0);
			   echo "Team ID: " . $team_id;
?>

  </div>
    <div id="site_content_bottom"></div>
    </div>
  </div>
</body>
</html>