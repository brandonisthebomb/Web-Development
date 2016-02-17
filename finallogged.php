<?php
error_reporting(E_ERROR | E_PARSE);
session_start(); // Starting session cookies
if($_SESSION['LOGGEDIN'] == 1)  //Checking if they have the session cookie
{
    echo "<title>Members area</title>";
    // Has session cookie
    echo "Welcome to the members area! <br> THIS IS A VERY EXCLUSIVE CLUB!";

}

else
{
    echo "<title>Error!</title>";
    //Doesn't have session cookie
    echo "YOU ARE NOT LOGGED IN!";
}
?>