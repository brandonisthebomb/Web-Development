<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
mysql_connect("localhost", "root", ""); // Server connection
mysql_select_db("myfirstdatabase"); // Database selection
$page = $_POST['registerform']; // Setting the page value
$user = $_POST['usrnme']; // Setting the user value
$pass = $_POST['pwd']; // Setting the pass value

if($page == 1)
{
    //This means that the page is the register form so the register form code goes here
    $query = mysql_query("select * FROM userdata WHERE username = '$user'"); // Queries the Database to check if the user already exists
    if(mysql_num_rows($query) !== 0) // Checks if there is any rows with that user
    {
        echo "THIS USER IS ALREADY TAKEN!"; // Stops there 
    }
    else
    {
        mysql_query("INSERT INTO userdata (username, password) VALUES('$user', '$pass')"); // Inserts into the database.
        echo "REGISTERED! <BR> <a href='finallogin.php'>Go to the login page</a>"; //Link and text to go to the login
    }    
}

if($page == 0)
{
    //This means that the page is the login form so the register form code goes here
    $query = mysql_query("SELECT username FROM userdata WHERE username = '$user'"); // Queries the Database to check if the user doesn't exist
    if(mysql_num_rows($query) == 0) // Checks if there is any rows with that user
    {
        echo "User doesn't exist"; // Stops there 
    }
    $query = mysql_query("SELECT username FROM userdata WHERE username = '$user' AND password = '$pass'");
    if(mysql_num_rows($query) !== 0) // Checks if there is any rows with that user and pass
    {
        echo "LOGGED IN! <BR> <a href='finallogged.php'>Go to the logged in</a>"; //Link and text to go to the login
        $_SESSION['LOGGEDIN'] = 1;
    }
    
}
?>