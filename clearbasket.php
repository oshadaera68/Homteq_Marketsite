<?php
session_start();
include("db.php");
$pagename = "Clear Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
include ("detectlogin.php"); 
echo "<h4>".$pagename."</h4>";
unset($_SESSION['basket']);
echo "<P>Your basket has been cleared!";
include ("footfile.html");
echo "</body>";