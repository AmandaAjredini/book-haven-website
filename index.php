<html lang="en">
    <!-- Include common head tag -->
    <?php include "head.php" ?> 
	<body>
        <div id="main">
           <?php
                // Include common header tag
                include "header.php";

                // Check if user is not logged in
                if (!isset($_SESSION["username"])) 
                {
                    // If user isn't logged in, ask them to login using hyperlink
                    echo '<p>Please <a href="login.php">Log In</a> for access.</p>'; 
                }
                else
                { 
                    // If user is logged in, display welcome message and give option to logout using hyperlink
                    echo '<p>Welcome, ' . '<strong>' . stripslashes($_SESSION["username"]) . '</strong>' . '! Click here to <a href="logout.php" title="Logout">Logout.</a></p>';
                }
            ?>
            <br><br><br>
            <!-- Include common footer tag -->
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
