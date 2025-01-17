<?php
    // Pagination links
    echo "<div class='pagination'>";

    // Display a "Previous" link if current page is greater than 1
    if ($current_page > 1) 
    {
        echo "<a href='view_reservations.php?page=" . ($current_page - 1) . "'>Previous</a> ";
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
            echo "<a href='view_reservations.php?page=$page'>$page</a> ";
        }
    }

    // Display a "Next" link if current page is less than total pages
    if ($current_page < $total_pages) 
    {
        echo "<a href='view_reservations.php?page=" . ($current_page + 1) . "'>Next</a>";
    }
    echo "</div>";
?>