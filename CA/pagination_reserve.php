<?php  
    // Pagination
    $results_per_page = 5; // Number of results per page
    $current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1; // Determine current page
    $offset = ($current_page - 1) * $results_per_page; // Offset for SQL query pagination

    // Get the total count of books for pagination
    $total_books_query = "SELECT COUNT(*) AS total FROM ($search_sql) AS subquery";
    $total_result = mysqli_query($conn, $total_books_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_books = $total_row['total'];

    // Calculate total number of pages for pagination
    $total_pages = ceil($total_books / $results_per_page);

    // Add pagination limits to the query
    $search_sql .= " LIMIT $offset, $results_per_page";
    $search_result = mysqli_query($conn, $search_sql);
?>