

<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "school";

$db = new mysqli($servername, $username, $password, $database);
mysqli_set_charset($db, "utf8");
$con = $db;
if($db->connect_error){
    die("connection failed: ". $db->connect_error);
}
//else{
//     echo "success";
// }
?>