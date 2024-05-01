<!-- write code for logout -->
<?php
    //start session
    session_start();
    //remove all session variables
    session_unset();
    //destroy the session
    session_destroy();
    //redirect to login page
    header("Location: ../signinup.php");
    exit;
    ?>