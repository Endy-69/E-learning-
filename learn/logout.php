<?php
session_start();
session_destroy();
unset($_SESSION[$username]);
unset($_SESSION[$userid]);
header("Location: login.php");
?>

