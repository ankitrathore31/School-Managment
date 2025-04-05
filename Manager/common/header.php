<?php
include("connection.php");

$query = "SELECT * FROM school LIMIT 1";
$result = mysqli_query($db, $query);

$school = mysqli_fetch_assoc($result);
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
        body {
            background-color: #E6EBEE;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            /* Adjust height as needed */
            background-color: #4D44B5;
            /* Dark background color */
            padding-top: 20px;
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
            scroll-snap-type: none;
        }

        .sidebar .nav-link {
            color: white;
            /* Light text color */
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 1px solid #374151;
            /* Darker border */
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #4D44B5;
            /* Darker background on hover */
        }

        .sidebar .dropdown-menu {
            background-color: #4D44B5;
            /* Dark dropdown background */
        }

        .sidebar .dropdown-item {
            color: white;
            /* Light text color */
        }

        .sidebar .dropdown-item:hover {
            background-color: #374151;
            /* Darker background on hover */
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            /* background-color: #E6EBEE; */
            /* Light content background */
        }

        .open-sidebar-btn {
            display: none;
            position: fixed;
            top: 10px;
            left: 8px;
            background-color: #1f2937;
            /* Dark button background */
            color: #d1d5db;
            /* Light button text color */
            border: none;
            padding: 5px 15px;
            font-size: 18px;
            border-radius: 5px;
            z-index: 1100;
        }

        @media (max-width: 991px) {
            .sidebar {
                left: -100%;
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
    <div class="main-content">
        <!-- Top Navigation Bar -->
        <div class="container-fluid text-white py-2 bg-white">
            <div class="row align-items-center">
                <div class="col-md-4 text-start">
                    <h5 class="text-black" style="color: black;"><?= $school['school_title']; ?></h5>
                </div>
                <div class="col-md-8 text-end d-flex justify-content-end align-items-center">
                    <div class="dropdown me-3">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Session
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php">2021</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
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
                    <h4 class="card-title text-black mt-1" style="font-size: 16px;">Hi, Manager</h4>
                </div>
            </div>
        </div>
        <ul class="nav flex-column m-3">
            <!-- Example menu items with icons -->
            <li class="nav-item">
                <a class="nav-link active" href="dashboard.php">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-graduate me-2"></i> Admission
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="add_student.php">New Admission</a></li>
                    <li><a class="dropdown-item" href="admission_list.php">Admission List</a></li>
                    <li><a class="dropdown-item" href="approve_admission.php">Approve Admission</a></li>
                    <li><a class="dropdown-item" href="reject_admission.php">Reject Admission</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-graduate me-2"></i> Student
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="student_list.php">Student List</a></li>
                    <li><a class="dropdown-item" href="student_report.php">Student Report</a></li>
                    <li><a class="dropdown-item" href="promote_student.php">Promote Student </a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="feesDropdown" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-money-check-alt me-2"></i> Fees
                </a>
                <ul class="dropdown-menu" aria-labelledby="feesDropdown">
                    <li><a class="dropdown-item" href="student_fees.php"><i class="fas fa-dollar-sign me-2"></i> Submit Fees</a></li>
                    <li><a class="dropdown-item" href="fees_report_list.php"><i class="fas fa-file-invoice-dollar me-2"></i> Fees Report</a></li>
                    <li><a class="dropdown-item" href="add_fees.php"><i class="fas fa-cogs me-2"></i> Manage Fees</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-users-cog me-2"></i> Staff
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="add_staff.php"><i class="fas fa-user-plus me-2"></i> Add Staff</a></li>
                    <li><a class="dropdown-item" href="staff_list.php"><i class="fas fa-list me-2"></i> Staff List</a></li>
                    <li><a class="dropdown-item" href="staff_access.php"><i class="fas fa-key me-2"></i> Staff Access</a></li>
                    <li><a class="dropdown-item" href="add_sallery.php"><i class="fas fa-wallet me-2"></i> Manage Salary</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-calendar-check me-2"></i> Attendance
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="take_stu_attendance.php"><i class="fas fa-user-check me-2"></i> Take Student Attendance</a></li>
                    <li><a class="dropdown-item" href="take_sta_attenadance"><i class="fas fa-user-clock me-2"></i> Take Staff Attendance</a></li>
                    <li><a class="dropdown-item" href="edit_stu_attendance.php"><i class="fas fa-edit me-2"></i> Edit Student Attendance</a></li>
                    <li><a class="dropdown-item" href="edit_sta_attendance.php"><i class="fas fa-edit me-2"></i> Edit Staff Attendance</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-file-alt me-2"></i> Exam
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-poll me-2"></i> Result</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-tasks me-2"></i> Manage Exam</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-ban me-2"></i> No-Dues</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-cog me-2"></i> Setting
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="add_timetable.php"><i class="fas fa-calendar-alt me-2"></i> Manage Time Table</a></li>
                    <li><a class="dropdown-item" href="add_class.php"><i class="fas fa-chalkboard-teacher me-2"></i> Manage Class</a></li>
                    <li><a class="dropdown-item" href="add_course.php"><i class="fas fa-book me-2"></i> Manage Course</a></li>
                    <li><a class="dropdown-item" href="add_subject.php"><i class="fas fa-book-reader me-2"></i> Manage Subject</a></li>
                    <li><a class="dropdown-item" href="add_transport.php"><i class="fas fa-bus me-2"></i> Manage Transport</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-bullhorn me-2"></i> Notice</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-book me-2"></i> Library
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="books_overview.php"><i class="fas fa-tachometer-alt me-2"></i>Books Overview</a></li>
                    <li><a class="dropdown-item" href="add_books.php"><i class="fas fa-plus-square me-2"></i> Add Books</a></li>
                    <li><a class="dropdown-item" href="books_list.php"><i class="fas fa-list me-2"></i> Books List</a></li>
                    <!-- <li><a class="dropdown-item" href="books_issued.php"><i class="fas fa-list me-2"></i> Issued & Return Book</a></li> -->
                    <li><a class="dropdown-item" href="issued_book_list.php"><i class="fas fa-list me-2"></i> Issued Book List</a></li>
                </ul>
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