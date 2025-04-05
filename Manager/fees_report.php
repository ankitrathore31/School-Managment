<?php
// Connect to Database
include("common/header.php");

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request. Student ID missing.");
}

// Get Student ID from URL
$id = intval($_GET['id']);

// Fetch Student Details
$student_query = "SELECT * FROM students WHERE id = $id";
$student_result = mysqli_query($db, $student_query);

if (mysqli_num_rows($student_result) == 0) {
    die("Student not found.");
}

// Fetch Student Data
$student = mysqli_fetch_assoc($student_result);

// Fetch Fee Transactions
$fee_query = "SELECT * FROM fee_transactions WHERE student_id = $id ORDER BY submission_date DESC";
$fee_result = mysqli_query($db, $fee_query);
?>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .print-container,
        .print-container * {
            visibility: visible;
        }

        .print-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: auto;
        }

        .card {
            page-break-after: always;
        }

        #printcontainer{
            display: none !important;
        }
    }
</style>
<div class="wrapper">
    <div class="main-content">
        <div class="container mt-5 ">
            <div class="row">
                <?php if (mysqli_num_rows($fee_result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($fee_result)) { ?>
                        <div class="col-md-6 col-sm-12 print-container mb-3" id="report-<?= $row['id']; ?>">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 text-center">
                                            <img src="<?= $school['logo']; ?>" alt="School Logo" class="img-fluid" style="max-height: 80px;">
                                        </div>
                                        <div class="col-md-7 col-sm-7 mt-1">
                                            <h4 class="text-center fw-bold"><?= $school['school_title']; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <p><strong>Name:</strong> <?= $student['name']; ?></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><strong>Student ID:</strong> <?= $student['student_id']; ?></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><strong>Class:</strong> <?= $student['class']; ?></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><strong>Roll No:</strong> <?= $student['student_rollno']; ?></p>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <p><strong>Father's Name:</strong> <?= $student['father']; ?></p>
                                        </div>
                                    </div>

                                    <hr>
                                    <h6 class="text-success">Fee Report</h6>
                                    <p class="text-center">
                                        <strong>Amount Paid:</strong> ₹<?= number_format($row['amount'], 2); ?><br>
                                        <strong>Fee Type:</strong> <?= ucfirst(str_replace('_', ' ', $row['fee_type'])); ?>
                                    </p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <p><strong>Submission Date:</strong> <?= date('d-m-Y', strtotime($row['submission_date'])); ?></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <p><strong>Signature:</strong> __________________</p>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3 print-hide" id="printcontainer">
                                        <button onclick="printReport()" class="btn btn-primary">
                                            <i class="fa fa-print"></i> Print
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-center text-danger">No fee submissions found.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    function printReport() {
        window.print();
    }
</script>

<?php

include("common/footer.php");

?>