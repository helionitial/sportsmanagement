<?php

// start or resume session
session_start();
session_commit();

/* Ensure that the user is either logged in or this is a "public" page that does
 * not require authentication. If this page is not public and the user is not 
 * logged in, redirect to login.php (which currently will redirect automatically
 * to the site homepage).
 */
// INSERT CODE HERE <-----------------------------------------------------------

$PUBLIC_PAGE[1] = "/~pal4ka/cs4750/index.php";
$PUBLIC_PAGE[2] = "/~pal4ka/cs4750/login.php";
$PUBLIC_PAGE[3] = "/~pal4ka/cs4750/register.php";
$PUBLIC_PAGE[4] = "/~pal4ka/cs4750/logout.php";

$ispresent = array_search($_SERVER["PHP_SELF"], $PUBLIC_PAGE);


if (!isset($_SESSION["user"]) and !$ispresent) {
	header("Location: login.php");
	exit; 	// ensure script terminates immediately
}

// open a database connection for the scripts that include this one
require_once "dbconnect.php";



/* headerOptions allows the (including) page to specify options to the header.
 * Options (key values of the array):
 *   title: page title (e.g., "title" => "INSERT PAGE TITLE HERE")
 */
if (! isset($headerOptions)) // not initialized, initialize with empty array
  $headerOptions = array();
else if (! is_array($headerOptions)) // not an array, raise warning
  trigger_error("Expecting header options to be an array", E_USER_WARNING);

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <title>IMSS<?php if (isset($headerOptions["title"])) echo " :: {$headerOptions["title"]}"; ?></title>
  
  <!-- stylesheets -->
  <link rel="stylesheet" href="styles.css" type="text/css" />
  
</head>

<body>

<div id="masthead">
  <a href="index.php" style="text-decoration: none;">

  </a>
</div> <!-- end masthead -->
