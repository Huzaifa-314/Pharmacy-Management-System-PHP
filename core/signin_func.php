<?php
include '../include/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $cpassword = mysqli_real_escape_string($conn, $_POST["password_confirmation"]);
    $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);

    // Check if email already exists
    $sql_check_email = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql_check_email);
    $num = mysqli_num_rows($result);

    if ($num == 0) {
        // Email doesn't exist, proceed with registration
        if ($password == $cpassword) {
            // Passwords match, hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into database
            $sql_insert_user = "INSERT INTO `user` (`u_name`, `email`, `password`, `phone`, `address`, `u_role`, `status`) VALUES ('$full_name', '$email', '$hash', '$phone', '$address', 'user', 1)";
            $insert_result = mysqli_query($conn, $sql_insert_user);

            // Check if user was inserted successfully
            if ($insert_result) {
                // Registration successful, redirect to signinup.php with success message and tab info
                header("Location: ../signinup.php?success=" . urlencode("Registration successful. Please login.") . "&tab=logintab");
                exit();
            } else {
                // Error occurred during registration
                $error = "Error: " . mysqli_error($conn);
            }
        } else {
            // Passwords don't match
            $error = "Passwords do not match.";
        }
    } else {
        // Email already exists
        $error = "Email already exists.";
    }

    // Redirect to signinup.php with error message and tab info
    header("Location: ../signinup.php?error=" . urlencode($error) . "&tab=signuptab");
    exit();
}
?>
