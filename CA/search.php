<?php
    // Fetch categories for the dropdown menu
    $categories = [];
    $category_query = "SELECT DISTINCT CategoryID, CategoryDescription FROM categories";
    $category_result = mysqli_query($conn, $category_query);
    
    // If SQL query is successful
    if ($category_result && mysqli_num_rows($category_result) > 0) 
    {
        // Loop through query result and add each row to categories array
        while ($row = mysqli_fetch_assoc($category_result)) 
        {
            $categories[] = $row;
        }
    }

    $book_name = $author = $category = '';

    // Check if the search form is submitted with the "Search" button.
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) 
    {
        // Retrieve search inputs and sanitise them to prevent SQL injection
        $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
    }
    
    // SQL search query based on inputs 
    $search_sql = "SELECT b.ISBN, b.BookTitle, b.Author, b.Edition, b.Year, c.CategoryDescription, b.Reserved
                    FROM books b
                    LEFT JOIN categories c ON b.CategoryID = c.CategoryID
                    WHERE 1=1";

    // If book name provided, search for books with titles that match
    if (!empty($book_name)) 
    {
        $search_sql .= " AND b.BookTitle LIKE '%$book_name%'";
    }

    // If author provided, search for books with that author
    if (!empty($author)) 
    {
        $search_sql .= " AND b.Author LIKE '%$author%'";
    }

    // If category selected, search for books within that category
    if (!empty($category)) 
    {
        $search_sql .= " AND b.CategoryID = '$category'";
    }

    // Order search results in alphabetical order (by book title)
    $search_sql .= " ORDER BY b.BookTitle ";

    // Check if user clicked "Reserve" button on a book
    if (isset($_POST['reserve_book'])) 
    {
        // Retrieve and sanitise book_isbn to prevent SQL injection
        $book_isbn = mysqli_real_escape_string($conn, $_POST['book_isbn']);
        $username = $_SESSION['username'];

        
        // Reserve the book by inserting into Reservations table
        $insert_query = "INSERT INTO Reservations (ISBN, Username) VALUES ('$book_isbn', '$username')";

        // If SQL query successful, update status of book
        if (mysqli_query($conn, $insert_query)) 
        {
            // Update the 'Reserved' status in Books table
            $update_book = "UPDATE Books SET Reserved = 'Y' WHERE ISBN = '$book_isbn'";
            mysqli_query($conn, $update_book);
            // Display success message
            $_SESSION['success'] = "Book reserved successfully!";
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1; // Get the current page number from the form submission
            header("Location: reserve.php?page=$current_page");
            exit;
        } 
        else 
        {
            // If there's an error reserving the book, display error message
            $_SESSION['error'] = "Error reserving the book.";
            // Redirect to refresh the page
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1; // Get the current page number from the form submission
            header("Location: reserve.php?page=$current_page");
            exit;
        }
        

        // Retain search criteria for re-running the query
        $book_name = $_POST['search_book_name'];
        $author = $_POST['search_author'];
        $category = $_POST['search_category'];
    }
?>