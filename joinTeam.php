<?php
require_once "dbconnect.php";
require_once "header.php";
$teamid=$_GET["tid"];
$leagueid=$_GET["lid"];

//$teamid="3";
//$leagueid="111";

$userid = $_SESSION['user'];


$sql="SELECT * FROM member_of NATURAL JOIN contest WHERE league_id=".$leagueid." AND user_id='".$userid."';";

$result = mysql_query($sql) or die($sql."<br/><br/>".mysql_error());;
//$row = mysql_fetch_array($result); 
 
//echo mysql_num_rows($result);

$sql2="SELECT gender FROM User WHERE user_id='".$userid."';";
$result2 = mysql_query($sql2) or die($sql."<br/><br/>".mysql_error());;

$sql3="SELECT league_type FROM League WHERE league_id='".$leagueid."';";
$result3=mysql_query($sql3) or die($sql."<br/><br/>".mysql_error());;

$row2 = mysql_fetch_array($result2);
$row3 = mysql_fetch_array($result3);
$gender = $row2['gender'];
$leaguetype = $row3['league_type'];






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
          <h1>Intramural<span class="green">Sports System</span></h1>
          <h2>your gateway to IM Sports</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.php">Home</a></li>
          <li><a href="registerTeam.php">Create Team</a></li>
          <li><a href="viewRoster.php">View Rosters</a></li>
          <li class="selected"><a href="getschedule.php">Leagues</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar">
        <!-- insert your sidebar items here -->
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
      <div id="content">
        <!-- insert the page content here -->
        
	<?php
		
		if (mysql_num_rows($result) != 0){ 
			echo "<h2><b>ERROR: Already in league team!</b></h2>";
			header("Location: myTeams.php");
		}
		else{ 
			if ($gender == 1 && $leaguetype == 'Womens') {
				echo "<h2><b>ERROR: Men cannot join Women's league!</b></h2>";
				header( 'refresh: 2; url=getschedule.php' );
			}
			
			else if ($gender == 0 && $leaguetype == 'Mens') {
				echo "<h2><b>ERROR: Women cannot join Men's league!</b></h2>";
				header( 'refresh: 2; url=getschedule.php' );
			}
			
			else  {
			$sql="INSERT INTO member_of (user_id, team_id) VALUES('".$userid."', '".$teamid."');";
			$result = mysql_query($sql);

			header("Location: myTeams.php");
			}
		}
	?>
		
		
      </div>
    <div id="site_content_bottom"></div>
    </div>
    <div id="footer">Copyright &copy; HTCuva. All Rights Reserved. | <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.dcarter.co.uk">design by dcarter</a></div>
  </div>
</body>
</html>