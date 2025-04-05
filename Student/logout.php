<?php
session_start();
session_destroy(); // Destroy session
header("Location: ../Home/stu-login.php");
exit;
?>