<?php
// conection file 
include("common/connection.php"); 
$query = "SELECT * FROM school LIMIT 1";
$result = mysqli_query($db, $query);

$school = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= $school['logo']; ?>" type="image/x-icon">
    <title><?= $school['school_title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome (for social media icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<style>
    .navv ul {
        justify-content: start;
        /* Center items horizontally */

    }

    .navv ul li a {
        color: white;
        display: flex;
        align-items: center;
        /* Align icons with text */
        gap: 5px;
        /* Space between icon and text */
        /* font-weight: bold; */
        font-size: 14px;
        font-weight: 500;
    }
</style>

<body>

<!-- header start -->
<div class="container-fluid">
    <div class="row" style="background-color: indigo; color: cornsilk;">
        <div class="col text-start m-2">
            <div class="contact-info">
                <i class="fas fa-phone-alt"></i>
                <span>+<?= $school['phone_number']; ?></span>
                <i class="fas fa-envelope"></i>
                <span><?= $school['email']; ?></span>
            </div>
        </div>
        <div class="col text-end m-1">
            <a href="<?= $school['facebook_link']; ?>" class="btn  btn-light">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="<?= $school['twitter_link']; ?>" class="btn btn-light">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="<?= $school['instagram_link']; ?>" class="btn btn-light">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </div>
</div>
<!-- logo & Title & navbar start -->
<div class="container-fluid">
    <div class="row" style="background-color: ghostwhite;">
        <div class="col-md-2">
            <a href="">
                <img src="<?= $school['logo']; ?>" width="150" height="130" alt="">
            </a>
        </div>
        <div class="col-md-4 mt-3">
            <h3><b><?= $school['school_title']; ?></b></h3>
            <p><b><?= $school['school_subtitle']; ?></b></p>
        </div>
        <div class="col-md-6 mt-4">
            <div class="navbar navbar-expand-lg" style="background-color: blue;">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse navv" id="navbarSupportedContent">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">
                                    <i class="fas fa-home"></i> Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#about" class="nav-link">
                                    <i class="fas fa-users"></i> About Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#gallery" class="nav-link">
                                    <i class="fas fa-image"></i> Gallery
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#contact" class="nav-link">
                                    <i class="fas fa-phone-alt"></i> Contact Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="stu-login.php" target="_blank" class="nav-link">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>