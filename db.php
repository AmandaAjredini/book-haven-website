<?php
    // Create variables to store server name, username, password and database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library";

    // Create connection using above variables
	$conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection to make sure it worked, if it didn't display an error message
	if ($conn->connect_error) 
    {
        die("Connection failed: ".$conn->connect_error);
    }
?>
