<!-- Search Form -->
<h2>Book Search</h2>
<div id="search_form">
    <form method="POST">
        <label for="book_name">Book Name:</label>
        <input type="text" name="book_name" id="book_name" value="<?= htmlspecialchars(stripslashes($book_name)) // Retain previously entered value?>">

        <label for="author">Author:</label>
        <input type="text" name="author" id="author" value="<?= htmlspecialchars(stripslashes($author)) // Retain previously entered value?>">

        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">-- Select Category --</option>
            <?php foreach ($categories as $cat): ?>
                <!-- Dropdown list for categories -->
                <option value="<?= $cat['CategoryID'] ?>" <?= $cat['CategoryID'] == $category ? 'selected' : '' ?>>
                    <?= $cat['CategoryDescription'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="search" value="Search">
    </form>
</div>
<br>