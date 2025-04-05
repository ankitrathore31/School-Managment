<?php session_start();
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin'){
    header("location: ../Home/login.php");
    exit();
}

include("common/header.php");

?>





<?php include("common/footer.php");
?>