<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>A V School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <style>
        body {
            background-color: #E6EBEE;
        }

        .dashboard-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
    <div class="container-fluid" style="background: linear-gradient(90deg, #4b43ae, #6a5acd);">
        <div class="row align-items-center justify-content-between ">
            <!-- Left Side Text -->
            <div class="col-auto">
            <h5 class="text-white" style="color: white;">Avid Vista School</h5>
            </div>

            <!-- Right Side Icons -->
            <div class="col-auto d-flex align-items-center m-2">
                <!-- Notification Bell Dropdown -->
                <div class="dropdown me-3">
                    <button class="btn btn-light btn-sm" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bell fa-lg"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <li><a class="dropdown-item" href="#">New Notification 1</a></li>
                        <li><a class="dropdown-item" href="#">New Notification 2</a></li>
                        <li><a class="dropdown-item" href="#">View All</a></li>
                    </ul>
                </div>

                <!-- User Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light btn-sm" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user fa-lg"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider"> 
                        </li>
                        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #4b43ae;">
        <div class="container">
            <!-- <a class="navbar-brand" href="#">Welcome 'Student Name'</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
                    </li>

                    <!-- Academics Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="academicsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-graduation-cap"></i> Academics
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="academicsDropdown">
                            <li><a class="dropdown-item" href="#">Subjects</a></li>
                            <li><a class="dropdown-item" href="#">Timetable</a></li>
                            <li><a class="dropdown-item" href="#">Teachers</a></li>
                        </ul>
                    </li>

                    <!-- Fees Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="feesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-money-bill-wave"></i> Fees
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="feesDropdown">
                            <li><a class="dropdown-item" href="#">Fee Structure</a></li>
                            <li><a class="dropdown-item" href="#">Payment History</a></li>
                            <li><a class="dropdown-item" href="#">Pay Fees</a></li>
                        </ul>
                    </li>

                    <!-- Exam Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="examDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-file-pen"></i> Exams
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="examDropdown">
                            <li><a class="dropdown-item" href="#">Exam Schedule</a></li>
                            <li><a class="dropdown-item" href="#">Results</a></li>
                            <li><a class="dropdown-item" href="#">Online Exams</a></li>
                        </ul>
                    </li>

                    <!-- Notice -->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-bullhorn"></i> Notice</a>
                    </li>

                    <!-- Complaint -->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-comments"></i> Complaint</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    include("footer.php");
    ?>