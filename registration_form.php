<!-- Registration Form -->
<div id="register">
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username">

        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Must be exactly 6 characters long">

        <label for="password_confirm">Confirm Password:</label>
        <input type="password" name="password_confirm">

        <label for="name">First Name:</label>
        <input type="text" name="name">

        <label for="surname">Surname:</label>
        <input type="text" name="surname">

        <label for="address1">Address Line 1:</label>
        <input type="text" name="address1">

        <label for="address2">Address Line 2:</label>
        <input type="text" name="address2">

        <label for="city">City:</label>
        <input type="text" name="city">

        <label for="telephone">Telephone:</label>
        <input type="text" name="telephone" placeholder="e.g. 9123456">

        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" placeholder="e.g. 0812345678">

        <div class="button-container">
            <input type="submit" value="Register">
            <a href="login.php">Cancel</a>
        </div>
    </form>
</div>
            