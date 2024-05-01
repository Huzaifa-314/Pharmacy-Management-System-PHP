<?php


// Start session


function isLoggedIn() {
    // Check if the 'login_user' session variable is set
    return isset($_SESSION['login_user']);
}