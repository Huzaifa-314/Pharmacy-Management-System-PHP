<?php
include '../include/connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // email and password sent from form 
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT id, password FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['login_user'] = $email; // Store email in session
            $_SESSION['user_id'] = $row['id']; // Store user ID in session
            header("location: ../index.php");
            exit();
        } else {
            $error = "Invalid login credentials";
        }
    } else {
        $error = "Your login email is invalid";
    }

    header("location: ../signinup.php?error=" . urlencode($error));
}
?>
