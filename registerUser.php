<?php
//Okay up here, we will connect to the database:
require_once "dbconnect.php";
$md5c = "sdfawe23q45gsfd533fgad";
?>
<html>
<head>
<title>Register User</title>
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
		<h1>Registration</h1>
	  
        <form action="" method="post">
            <p>User ID: <input type="text" name="userid"></p>
			<p>First Name: <input type="text" name="firstname"></p>
			<p>Last Name: <input type="text" name="lastname"></p>
			<p>Gender: <br>
			<input type="radio" name="gender" value="1" /> Male<br />
			<input type="radio" name="gender" value="0" /> Female</p>
			<p>Address: <input type="text" name="address"></p>
			<p>Phone: <input type="text" name="phone"></p>
			<p>E-Mail: <input type="text" name="email"></p>
			
            <p>Password: <input type="password" name="pass1"></p>
            <p>Repeat Password: <input type="password" name="pass2"></p>
            
            <p><input type="submit" name="submit" value="Complete Registration"></p>
        </form>
        <?php
        	$table_name = "User";

            //Okay so here is the php for the register page.
            //I know the page design is a white  page with a form in the middle, but this is on PHP, not HTML.
            if(isset($_POST['submit'])) { 					//this will check if the form was submitted.
                $userid = mysql_real_escape_string($_POST['userid']); 				//set form information into variables / prevent SQL injection
				$firstname = mysql_real_escape_string($_POST['firstname']);
				$lastname = mysql_real_escape_string($_POST['lastname']);
				$gender = mysql_real_escape_string($_POST['gender']);
				$address = mysql_real_escape_string($_POST['address']);
				$phone = mysql_real_escape_string($_POST['phone']);
                $email = mysql_real_escape_string($_POST['email']); 
				$pass1 = mysql_real_escape_string($_POST['pass1']); 
                $pass2 = mysql_real_escape_string($_POST['pass2']); 

				
				// Form-checking (REPLACE WITH JAVASCRIPT LATER)
                if($userid == "" || $firstname == "" || $lastname == "" || $gender == "" || $address == "" || $phone == "" || $email == "" || $pass1 == "" || $pass2 == "") { //check for any empty fields
                    die("<p><font color='red'>Error: One or more fields are empty. Please fill them and try again.</font></p>"); //warn them that one or more fields are empty.
                }
                if($pass1 != $pass2) { //the passwords do not match
                    die("<p><font color='red'>Error: The passwords do not match.</font></p>");
                }
                $q = "SELECT * FROM ".$table_name." WHERE user_id='".$userid."'";
                $result = mysql_query($q) or die(mysql_error().": $q"); //this query will be used to check for the same username
                $n1 = mysql_num_rows($result); //this will return 0 if there are no $table_name with that name
                if($n1 != 0) { //if there are any $table_name, it will return how many there are, and we can stop the signup
                    die("<p><font color='red'>Error: The username is already in use.</font></p>"); //let them know
                }
                $q = "SELECT * FROM ".$table_name." WHERE email='".$email."'";
				$result = mysql_query($q) or die(mysql_error().": $q"); //this query will check if the email is in use.
                $n2 = mysql_num_rows($result); //if you read above, you should understand what this is for.
                if($n2 != 0) { //someone else has that email
                    die("<p><font color='red'>Error: The email address is in use by another user.</font></p>"); //so tell the user
                }
                
                
				// Prepare for insertion into DB
                                
                $pass = md5($pass1,$md5c); //md5 the pass with the code entered at the top of the page
			
				$sql="INSERT INTO $table_name (user_id, last_name, first_name, address, phone, email, password, gender, admin) 
				VALUES('".$userid."', '".$lastname."', '".$firstname."', '".$address."', '".$phone."', '".$email."', '".$pass."', '".$gender."', '0')";
				

				$result=mysql_query($sql)or die('Query failed: ' . mysql_error() . "<br />\n$sql");
                
				header("Location: login.php");
                    
			}
        ?>
    </div>
</body>
</html>