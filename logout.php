<?php
session_start();
session_unset();
session_destroy(); // Destroy the session to log out the user

header("Location: index.php"); // Redirect to the home page after logout
exit(); // Ensure no further code is executed after the redirect
?>