<?php
    // Remove reservation
    // Check if "Remove" button is pressed to remove a reservation
    if (isset($_POST['remove_reservation'])) 
    {
        // Retrieve ISBN of  book to be removed and sanitise it to prevent SQL injection
        $ISBN = mysqli_real_escape_string($conn, $_POST['reservation_id']);
        
        // SQL query to delete the reservation record
        $remove_sql = "DELETE FROM reservations WHERE ISBN = '$ISBN' AND Username = '$username'";
        
        if (mysqli_query($conn, $remove_sql)) 
        {
            // If the reservation is successfully removed, update the Books table
            $update_book_sql = "UPDATE books SET Reserved = 'N' WHERE ISBN = '$ISBN'";
            
            // If query executes successfully display message
            if (mysqli_query($conn, $update_book_sql)) 
            {
                // Store success message in session
                $_SESSION['success'] = "Reservation removed successfully.";
                // Redirect to the same page to refresh the list
                header("Location: view_reservations.php");
                exit; // Make sure no further code is executed
            }
        } 
        else 
        {
            // Store error message in session
            $_SESSION['error'] = "Error removing reservation: " . mysqli_error($conn);
            // Redirect to the same page
            header("Location: view_reservations.php");
            exit;
        }
    }
?>