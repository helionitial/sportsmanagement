<?php
	include('dbconnect.php');
    session_start(); //better start the session
    //This page will be simple, no text, just log them out and redirect them.
    if(isset($_SESSION['user'])) { //make sure they are logged in
        unset($_SESSION['user']); //unset the username date
        unset($_SESSION['loggedin']); //unset the field stating they are logged in
        unset($_SESSION['email']); //unset the email data
		unset($_SESSION['admin']);
        header("Location: login.php"); //redirect them to the login page
    } else { //if they aren't...
        header("Location: login.php"); //...then send them to the login page
    }
?> w