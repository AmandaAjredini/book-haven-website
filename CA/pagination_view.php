<?php
    // Setup Pagination variables
    $results_per_page = 5; // Number of results per page
    $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page number
    $offset = ($current_page - 1) * $results_per_page; // Calculate the offset for SQL query

    // Get the total number of reservations for the user
    $total_reservations_query = "SELECT COUNT(*) AS total FROM reservations WHERE Username = '$username'";
    $total_count_result = mysqli_query($conn, $total_reservations_query);
    $total_count_row = mysqli_fetch_assoc($total_count_result);
    $total_reservations = $total_count_row['total'];

    // Calculate the total number of pages
    $total_pages = ceil($total_reservations / $results_per_page);

    // SQL Query to get paginated results
    $reserved_books_sql = "SELECT b.ISBN, b.BookTitle, b.Author, b.Edition, b.Year, c.CategoryDescription, r.ReservedDate 
                            FROM books b
                            JOIN reservations r ON b.ISBN = r.ISBN
                            JOIN categories c ON b.CategoryID = c.CategoryID
                            WHERE r.Username = '$username'
                            ORDER BY r.ReservedDate DESC
                            LIMIT $offset, $results_per_page";

    $reserved_books_result = mysqli_query($conn, $reserved_books_sql);
?>