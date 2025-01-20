<html lang="en">
    <!-- Include common head tag -->
    <?php include "head.php" ?>
    <body>
        <div id="main">
            <!-- Include common header tag -->
            <?php include "header.php" ?>
            <?php
                // Include database connection
                require_once 'db.php'; 

                // Check if the user is logged in, if not ask them to log in
                if (!isset($_SESSION['username'])) 
                {
                    echo '<p>Please <a href="login.php">Log In</a> to reserve a book.</p>';
                    echo "<br><br><br>";
                    include 'footer.php'; // Display footer even when user is logged out
                    exit;
                }

                include "search.php"; // Include search by book, author, category
                
                include "pagination_reserve.php"; // Include pagination logic
                
                include "search_form.php"; // Include search form

                // Display success message
                if (isset($_SESSION['success'])) 
                {
                    echo "<p style='color: green;'><strong>" . $_SESSION['success'] . "</strong></p>";
                    unset($_SESSION['success']); // Clear the message after displaying
                }

                // Display error message
                if (isset($_SESSION['error'])) 
                {
                    echo "<p style='color: red;'><strong>" . $_SESSION['error'] . "</strong></p>";
                    unset($_SESSION['error']); // Clear the message after displaying
                }
            
                include "search_results.php"; // Include search table results + pagination links
                
                // Close database connection
                $conn->close();
                echo "<br><br><br>";
                
                // Include common footer tag
                include 'footer.php'; 
            ?>
        </div>
    </body>
</html>
