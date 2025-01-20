<!-- Search Results -->
<?php
    // Check if there are search results and display them in a table
    if (isset($search_result) && mysqli_num_rows($search_result) > 0) 
    {
        echo "<div id='search_results'>";
        echo "<table border='1'>
                <tr>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Edition</th>
                    <th>Year</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>";

        // Loop through each book in results and display in a row
        while ($row = mysqli_fetch_assoc($search_result)) 
        {
            // If book is not reserved display "Reserve" button, if reserved display "Not Available"
            $reserved_status = $row['Reserved'] == 'Y' ? "Reserved" : "Available";
            $reserve_button = $row['Reserved'] == 'Y' ? "Not Available"
                : "<form action='' method='POST'>
                        <input type='hidden' name='book_isbn' value='" . $row['ISBN'] . "'>
                        <input type='hidden' name='search_book_name' value='" . htmlspecialchars($book_name) . "'>
                        <input type='hidden' name='search_author' value='" . htmlspecialchars($author) . "'>
                        <input type='hidden' name='search_category' value='" . htmlspecialchars($category) . "'>
                        <input type='hidden' name='page' value='" . (isset($_GET['page']) ? $_GET['page'] : 1) . "'>
                        <input type='submit' name='reserve_book' value='Reserve'>
                </form>";

            echo "<tr>
                    <td>" . htmlspecialchars($row['BookTitle']) . "</td>
                    <td>" . htmlspecialchars($row['Author']) . "</td>
                    <td>" . htmlspecialchars($row['Edition']) . "</td>
                    <td>" . htmlspecialchars($row['Year']) . "</td>
                    <td>" . htmlspecialchars($row['CategoryDescription']) . "</td>
                    <td>" . $reserved_status . "</td>
                    <td>" . $reserve_button . "</td>
                </tr>";
        }

        echo "</table>";
        echo "</div>";

        include "pagination_links_reserve.php";
    }
    else 
    {
        // If no books match the search, display message that no results were found
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) 
        {
            echo "<p>No books found matching your search.</p>";
        }
    }
?>