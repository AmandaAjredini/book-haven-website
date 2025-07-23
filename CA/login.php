<html lang="en">
    <!-- Include common head tag -->
    <?php include "head.php" ?>
    <body>
        <div id="main">
            <!-- Include common header tag -->
            <?php include "header.php" ?>
            <h2>Log In</h2>
            <?php
                // Check if there is an error and displays error message in red
                if(isset($_SESSION["error"]))
                {
                    echo('<p style="color:red">Error: ') . $_SESSION["error"] . "</p>\n";
                    // Prevent error from reappearing when page is reloaded
                    unset($_SESSION["error"]);
                }
           
                // Include database connection
                require_once 'db.php';

                // Make sure that any user previously logged-in is logged out
                unset($_SESSION["username"]); 

                // Check if form was submitted
                if (isset($_POST["submit"])) 
                {
                    // Retrieve and sanitise username and password inputs to prevent SQL injection
                    $username = mysqli_real_escape_string($conn, $_POST["username"]);
                    $password = mysqli_real_escape_string($conn, $_POST["password"]);

                    // Ensure both username and password fields are filled in
                    if ($username != "" && $password != "") 
                    {
                        // Check if username exists
                        $user_check = "SELECT Username FROM Users WHERE Username='$username'";
                        $result_user_check = mysqli_query($conn, $user_check);

                        if (mysqli_num_rows($result_user_check) > 0) 
                        {
                            // If username exists, verify password
                            $user_sql = "SELECT Password FROM Users WHERE Username='$username'";
                            $user_result = mysqli_query($conn, $user_sql);
                            $row = mysqli_fetch_assoc($user_result);
                            
                            // Check if password entered matches stored password for that username
                            if ($row['Password'] === $password) 
                            {
                                // If password matches, login successful
                                $_SESSION["username"] = $username;
                                // Redirect user to home page
                                header('Location: index.php');
                            } 
                            else 
                            {
                                // If password is incorrect, set an error message and redirect to login page
                                $_SESSION["error"] = "Invalid password. Please try again.";
                                header('Location: login.php');
                            }
                        } 
                        else 
                        {
                            // If username does not exist, set an error messge and redirect to login page
                            $_SESSION["error"] = "Invalid username. Please register or try again.";
                            header('Location: login.php');
                        }
                    } 
                    else 
                    {
                        // If user left both fields empty, set an error message and redirect to login page
                        $_SESSION["error"] = "Please enter both username and password.";
                        header('Location: login.php');
                    }
                }
                // Close the database connection
                $conn->close();
            
                // Include log in form
                include "login_form.php";
                // Redirect user to registration page if they do not have an account
                echo "<p>Don't have an account?   <a href='register.php'>Register Here!</a></p>";
                // Include common footer tag -->
                include 'footer.php'; 
            ?>
        </div>
    </body>
</html>
