<html lang="en">
    <!-- Include common head tag -->
    <?php include "head.php" ?>
    <body>
        <div id=main>
            <!-- Include common header tag -->
            <?php include "header.php" ?>
            <?php
                // Include database connection
                require_once 'db.php'; 

                // Check if the user is logged in by checking the session username variable
                if (!isset($_SESSION['username'])) 
                {
                    // If user is not logged in, ask user to log in for access to page
                    echo '<p>Please <a href="login.php">Log In</a> to view your reserved books.</p>';
                    echo '<br><br><br>';
                    include 'footer.php'; //display footer even when user is logged out
                    exit; // Stop further code execution
                }

                // Get the logged-in username
                $username = $_SESSION['username']; 

                // Check and display success message
                if (isset($_SESSION['success'])) 
                {
                    echo "<p style='color: green;'><strong>" . $_SESSION['success'] . "</strong></p>";
                    unset($_SESSION['success']); // Clear the message after displaying
                }

                // Check and display error message
                if (isset($_SESSION['error'])) 
                {
                    echo "<p style='color: red;'><strong>" . $_SESSION['error_message'] . "</strong></p>";
                    unset($_SESSION['error']); // Clear the message after displaying
                }


                include 'pagination_view.php'; // Include pagination logic

                // If user has reserved books, display them in a table
                if (mysqli_num_rows($reserved_books_result) > 0) 
                {
                    echo "<h2>Reserved Books</h2>";
                    echo "<div id='view'>";
                    echo "<table border='1'>
                            <tr>
                                <th>Book Name</th>
                                <th>Author</th>
                                <th>Edition</th>
                                <th>Year</th>
                                <th>Category</th>
                                <th>Reservation Date</th>
                                <th>Action</th>
                            </tr>";

                    // Loop through reserved books and display them in the table.
                    // For each book, create a form with a hidden input field (reservation_id) that holds the ISBN of the reserved book and a submit button to remove the reservation.
                    while ($reserved_row = mysqli_fetch_assoc($reserved_books_result)) 
                    {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($reserved_row['BookTitle']) . "</td>";
                            echo "<td>" . htmlspecialchars($reserved_row['Author']) . "</td>";
                            echo "<td>" . htmlspecialchars($reserved_row['Edition']) . "</td>";
                            echo "<td>" . htmlspecialchars($reserved_row['Year']) . "</td>";
                            echo "<td>" . htmlspecialchars($reserved_row['CategoryDescription']) . "</td>";
                            echo "<td>" . htmlspecialchars($reserved_row['ReservedDate']) . "</td>";
                            echo "<td>
                                    <form method='POST'>
                                        <input type='hidden' name='reservation_id' value='" . htmlspecialchars($reserved_row['ISBN']) . "'>
                                        <input type='submit' name='remove_reservation' value='Remove'>
                                    </form>
                                </td>";
                            echo "</tr>"; 
                    }
                    echo "</table>";
                    echo "</div>";
                    
                    include "pagination_links_view.php"; // Include pagination links
                } 
                else 
                {
                    // Display message if user hasn't reserved any books
                    echo "<p>You have not reserved any books.</p>";
                }

                // Include reservation removal logic
                include 'remove_reservation.php';
                
                // Close the connection
                $conn->close();
                echo "<br><br>";

                // Include common footer
                include 'footer.php'; 
            ?>
        </div>
    </body>
</html>
