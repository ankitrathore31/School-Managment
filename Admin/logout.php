<?php
session_start();
session_destroy();
header("location: ../Home/login.php");

?>