<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.html"); // Redirect if not logged in
    exit();
}
?>

