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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: black;
            padding-top: 20px;
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            background-color: rgb(107, 153, 153) !important;
        }

        .sidebar .nav-link {
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 1px solid rgb(168, 192, 192);
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
        }

        .sidebar .dropdown-menu {
            background-color: #495057;
        }

        .sidebar .dropdown-item {
            color: #fff;
        }

        .sidebar .dropdown-item:hover {
            background-color: #6c757d;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .open-sidebar-btn {
            display: none;
            position: fixed;
            top: 10px;
            left: 8px;
            background-color: black;
            color: #fff;
            border: none;
            padding: 5px 15px;
            font-size: 18px;
            border-radius: 5px;
            z-index: 1100;
        }



        @media (max-width: 991px) {
            .sidebar {
                left: -100%;
                width: 250px;
                height: 100vh;
                position: fixed;
                transition: all 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .open-sidebar-btn {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- Top Navigation Bar -->
    <div class="container-fluid text-white py-2 border-bottom" style="background-color: white;">
        <div class="row align-items-center">
            <div class="col-md-4 text-start"></div>
            <div class="col-md-8 text-end d-flex justify-content-end align-items-center">
                <!-- <div class="dropdown me-3">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> Session
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="profile.php">2021</a></li>
                    </ul>
                </div> -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!-- <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profile</a></li> -->
                        <li><a class="dropdown-item" href="change_password.php"><i class="fas fa-key"></i> Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Open Sidebar Button -->
    <button class="open-sidebar-btn" id="openSidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="card shadow-lg" style="width: 200px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <div class="card-body p-0 bg-white">
                    <h4 class="card-title text-black mt-1" style="font-size: 16px;">Hi, Admin</h4>
                </div>
            </div>
        </div>
        <ul class="nav flex-column m-5">
            <li class="nav-item mt-3">
                <a class="nav-link active" href="dashboard.php">Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="manage_site.php">Manage Site</a>
            </li>

        </ul>
    </div>
    <script>
        // Sidebar toggle functionality
        document.getElementById("openSidebar").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("active");
        });

        // Ensure dropdowns work properly
    </script>

    <?php
    include("footer.php");
    ?>