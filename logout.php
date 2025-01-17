<?php
    session_start(); 
    session_unset();  // Unset all session variables (logging out user by removing all session data from current session)
    session_destroy(); // Destroy the entire session so user cannot access any data that was stored during the session
    header("Location: index.php");  // Redirect to home page
    exit();
?>
            