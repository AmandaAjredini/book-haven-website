<html lang="en">
    <!-- Include common head tag -->
    <?php include "head.php" ?>
    <body>
        <div id="main">
            <!-- Include common header tag -->
           <?php include "header.php" ?>
           <br>
           <h2>Registration</h2>
            <?php
                // Include database connection
                require_once 'db.php';

                // Display session errors if they exist
                if (isset($_SESSION['errors'])) 
                {
                    foreach ($_SESSION['errors'] as $error) 
                    {
                        echo "<p style='color: red;'>$error</p>";
                    }

                    unset($_SESSION['errors']); // Clear errors after displaying
                }

                // Check if form has been submitted via POST method
                if ($_SERVER['REQUEST_METHOD'] === 'POST') 
                {
                    // List of required fields in form
                    $fields = ["username", "password", "password_confirm", "name", "surname", "address1", "address2", "city", "telephone", "mobile"];
                    $errors = []; // Array to store error messages

                    $allFieldsFilled = true; // Flag to track if any field is blank

                    // Check if all required fields are filled out and not empty
                    foreach ($fields as $field) 
                    {
                        if (empty($_POST[$field])) 
                        {
                            $allFieldsFilled = false; // Mark as false if any field is empty
                            break; // No need to check further
                        }
                    }
                    
                    // Add a single error message if any field is blank
                    if (!$allFieldsFilled) 
                    {
                        $errors[] = "Error: All fields must be filled out.";
                    }
                    else
                    {
                        // Assign POST values to variables (Retrieve and sanitise inputs to prevent SQL injection)
                        $username = mysqli_real_escape_string($conn, $_POST['username']);
                        $password = mysqli_real_escape_string($conn, $_POST['password']);
                        $password_confirm = mysqli_real_escape_string($conn, $_POST['password_confirm']);
                        $name = mysqli_real_escape_string($conn, $_POST['name']);
                        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
                        $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
                        $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
                        $city = mysqli_real_escape_string($conn, $_POST['city']);
                        $telephone = mysqli_real_escape_string($conn, $_POST['telephone'] ?? '');
                        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

                        // Check if username already exists
                        $username_sql = "SELECT * FROM users WHERE Username = '$username'";
                        $username_result = mysqli_query($conn, $username_sql);

                        if (mysqli_num_rows($username_result) > 0) 
                        {
                            // Display error message if username exists
                            $errors[] = "Error: This username already exists.";
                        }

                        // Check if password is exactly 6 characters long
                        if (strlen($password) !== 6) 
                        {
                            // If it's not, display error message
                            $errors[] = "Error: Password must be exactly 6 characters.";
                        }

                        // Check if password matches password confirm field
                        if ($password !== $password_confirm) 
                        {
                            // If it doesn't match, display error message
                            $errors[] = "Error: Passwords do not match.";
                        }

                        // Check if mobile number entered contains only digits
                        if (!is_numeric($mobile)) 
                        {
                            // If not, display error message
                            $errors[] = "Error: Mobile number must contain only digits.";
                        }

                        // Check if mobile number is 10 digits long
                        if (strlen($mobile) !== 10) 
                        {
                            // If not, display error message
                            $errors[] = "Error: Mobile number must be exactly 10 digits.";
                        }

                        // Check if telephone number entered contains only digits
                        if (!is_numeric($telephone)) 
                        {
                            // If not, display error message
                            $errors[] = "Error: Telephone number must only contain digits.";
                        }

                        // Check if telephone number is 7 digits long
                        if (strlen($telephone) !== 7) 
                        {
                            // If not, display error message
                            $errors[] = "Error: Telephone number must be exactly 7 digits.";
                        }
                    }

                    // Check if there are any errors from above validation
                    if (empty($errors)) 
                    {
                        // If no errors found, proceed to insert data into database
                        $info_insert_sql = "INSERT INTO users 
                                (Username, Password, Firstname, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) 
                                VALUES ('$username', '$password', '$name', '$surname', '$address1', '$address2', '$city', '$telephone', '$mobile')";

                        if (mysqli_query($conn, $info_insert_sql)) 
                        {
                            // Registration successful, redirect to login page
                            header("Location: login.php");
                            exit();  // Stop further script execution
                        } 
                        else 
                        {
                            // If error inserting data into database, add database error to session errors
                            $_SESSION['errors'] = ['Database error: ' . mysqli_error($conn)];
                            header("Location: register.php");
                            exit();
                        }
                    } 
                    else 
                    {
                        // Store errors in session and redirect back to register page
                        $_SESSION['errors'] = $errors;
                        header("Location: register.php");
                        exit();
                    }
                }

                // Close database connection
                $conn->close();
            
                // Include registration form
                include "registration_form.php";
                echo "<br><br>";

                // Include common footer tag
                include 'footer.php'; 
            ?>
        </div>
    </body>
</html>
