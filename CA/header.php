<header>
    <!-- Separate the header on its own page as all pages will have the same header contents -->
    <nav>
        <ul>
            <a href="index.php">Home</a>
            <a href="reserve.php">Reserve</a>
            <a href="view_reservations.php">View Reservations</a>
            <a href="logout.php">Logout</a>
            <?php
                // Start new session to allow information storage across multiple pages 
                session_start();

                // Check if the user is logged in first
                if (isset($_SESSION['username'])) 
                {
                    // Display the username next to Logout if user is logged in
                    echo "<span>Logged in as: " . stripslashes($_SESSION['username']) . "</span>";
                }
            ?>
        </ul>
    </nav>
</header>
<h1>Amanda's Book Haven</h1>