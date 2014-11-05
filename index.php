<?
include('dbconnect.php');
session_start();
echo $_SESSION['admin'];


if ($_SESSION['admin'] != '1') {
	header("Location: myTeams.php");
	
}

else {
	header("Location: admin.php");
exit; 	// ensure script terminates immediately
}

	
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
  <title>RecSports</title>
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
          <li class="selected"><a href="index.php">Home</a></li>
          <li><a href="registerTeam.php">Create Team</a></li>
          <li><a href="viewRoster.php">View Rosters</a></li>
          <li><a href="getschedule.php">Leagues</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        <h1>Dashboard</h1>
		<p> The admin can post important notice here.</p>
        <h1>Browser Compatibility</h1>
        <p>This template has been tested in the following browsers:</p>
        <ul>
          <li>Internet Explorer 8</li>
          <li>Internet Explorer 7</li>
          <li>FireFox 3</li>
          <li>Google Chrome 2</li>
          <li>Safari 4</li>
        </ul>
      </div>
    <div id="site_content_bottom"></div>
    </div>
  </div>
</body>
</html>

