<?php
session_start();
session_destroy(); // Destroy session
header("Location: ../Home/login.php");
exit;
?>