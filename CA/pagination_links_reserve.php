<?php
    // Pagination links
    echo "<div class='pagination'>";

    // Preserve search parameters
    $search_params = http_build_query([
        'book_name' => $book_name,
        'author' => $author,
        'category' => $category
    ]);
    
    // Display a "Previous" link if current page is greater than 1
    if ($current_page > 1) 
    {
        echo "<a href='reserve.php?page=" . ($current_page - 1) . "&$search_params'>Previous</a> ";
    }

    // Display links for each page
    for ($page = 1; $page <= $total_pages; $page++) 
    {
        if ($page == $current_page) 
        {
            echo "<strong>$page</strong> ";
        } 
        else 
        {
            echo "<a href='reserve.php?page=$page&$search_params'>$page</a> ";
        }
    }

    // Display a "Next" link if current page is less than total pages
    if ($current_page < $total_pages) 
    {
        echo "<a href='reserve.php?page=" . ($current_page + 1) . "&$search_params'>Next</a>";
    }
        
    echo "</div>";
?>