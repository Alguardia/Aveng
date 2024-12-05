<?php
// Start the session
session_start();

// Unset the session variable
$_SESSION = array();

// Destroy the session
session_destroy();

// Delete the "PHPSESSID" cookie
if (isset($_COOKIE['PHPSESSID'])) {
    setcookie('PHPSESSID', '', time() - 3600, '/');
}

// Redirect the user to the desired page
header('Location: ../index.php');
exit;
?>

