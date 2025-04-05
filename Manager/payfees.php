<?php
include("common/header.php");

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Query the database for the student with the given ID
    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Student not found'); window.history.back();</script>";
        exit();
    }

    // Query the database for the student payment details
    $query = "SELECT * FROM student_payments WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $student_fee = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Student Fees record not found'); window.history.back();</script>";
        exit();
    }
}

// Handle fee submission
if (isset($_POST['submit'])) {
    $submitted_amount = intval($_POST['submitted_fees']);
    $fees_type = $_POST['fees_type'];

    if ($student_fee['total_submitted_fee'] >= $student_fee['total_fee']) {
        echo "<script>alert('Your total fees are already fully submitted!');</script>";
        exit();
    }

    // Initialize variables for updating fees
    $updated_total_fee = $student_fee['total_submitted_fee'] + $submitted_amount;
    $pending_fee = $student_fee['total_fee'] - $updated_total_fee;
    $payment_status = ($pending_fee <= 0) ? 'Paid' : 'Pending';

    if ($fees_type == "exam_fee") {
        if ($student_fee['submitted_exam_fee'] >= $student_fee['exam_fee']) {
            echo "<script>alert('Your exam fees are already fully submitted!');</script>";
            exit();
        } elseif ($submitted_amount != $student_fee['exam_fee']) {
            echo "<script>alert('Exam Fees must be paid in full!');</script>";
            exit();
        }

        $updated_exam_fee = $student_fee['submitted_exam_fee'] + $submitted_amount;

        // Begin transaction
        mysqli_begin_transaction($db);

        // Update student_payments table
        $update_query = "UPDATE student_payments 
                        SET total_submitted_fee = $updated_total_fee, 
                            submitted_exam_fee = $updated_exam_fee,
                            pending_fee = $pending_fee, 
                            payment_status = '$payment_status' 
                        WHERE id = $id";
        
        // Insert into fee_transactions table
        $transaction_query = "INSERT INTO fee_transactions (student_id, amount, fee_type, submission_date) 
                             VALUES ($id, $submitted_amount, 'exam_fee', NOW())";

        $update_result = mysqli_query($db, $update_query);
        $insert_result = mysqli_query($db, $transaction_query);

        if ($update_result && $insert_result) {
            mysqli_commit($db);
            echo "<script>alert('Exam fees submitted successfully!'); window.location.href='payfees.php?id=$id';</script>";
        } else {
            mysqli_rollback($db);
            echo "<script>alert('Error in exam fee submission!');</script>";
        }
    } elseif ($fees_type == "tuition_fee") {
        if ($student_fee['submitted_tuition_fee'] >= $student_fee['tuition_fee']) {
            echo "<script>alert('Your tuition fees are already fully submitted!');</script>";
            exit();
        } elseif ($submitted_amount > ($student_fee['tuition_fee'] - $student_fee['submitted_tuition_fee'])) {
            echo "<script>alert('Your submission exceeds the remaining tuition fee balance!');</script>";
            exit();
        }

        $updated_tuition_fee = $student_fee['submitted_tuition_fee'] + $submitted_amount;

        // Begin transaction
        mysqli_begin_transaction($db);

        // Update student_payments table
        $update_query = "UPDATE student_payments 
                        SET total_submitted_fee = $updated_total_fee, 
                            submitted_tuition_fee = $updated_tuition_fee,
                            pending_fee = $pending_fee, 
                            payment_status = '$payment_status' 
                        WHERE id = $id";
        
        // Insert into fee_transactions table
        $transaction_query = "INSERT INTO fee_transactions (student_id, amount, fee_type, submission_date) 
                             VALUES ($id, $submitted_amount, 'tuition_fee', NOW())";

        $update_result = mysqli_query($db, $update_query);
        $insert_result = mysqli_query($db, $transaction_query);

        if ($update_result && $insert_result) {
            mysqli_commit($db);
            echo "<script>alert('Tuition fees submitted successfully!'); window.location.href='payfees.php?id=$id';</script>";
        } else {
            mysqli_rollback($db);
            echo "<script>alert('Error in tuition fee submission!');</script>";
        }
    } else {
        echo "<script>alert('Invalid fee type selected!');</script>";
    }
}

?>

<div class="main-content">
    <div class="container mt-5">
        <div class="card p-3 mb-3 shadow-sm">
            <div class="row">

                <!-- Basic Details Section -->
                <div class="col-md-9 col-sm-12">
                    <h4 class="text-center mb-3">Student Details</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th class="bg-light">Name</th>
                                    <td><?= $student['name']; ?></td>
                                    <th class="bg-light">Student ID</th>
                                    <td><?= $student['student_id']; ?></td>

                                </tr>
                                <tr>
                                    <th class="bg-light">Roll No</th>
                                    <td><?= $student['student_rollno']; ?></td>
                                    <th class="bg-light">Class</th>
                                    <td><?= $student['class']; ?></td>

                                </tr>
                                <tr>
                                    <th class="bg-light">Father Name</th>
                                    <td><?= $student['father']; ?></td>
                                    <th class="bg-light">Date of Birth</th>
                                    <td><?= $student['dob']; ?></td>

                                </tr>
                                <tr>
                                    <th class="bg-light">Gender</th>
                                    <td><?= $student['gender']; ?></td>
                                    <th class="bg-light">Enrollment Date</th>
                                    <td><?= $student['enrollment_date']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h5 class="mt-3">Fee Details</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th class="bg-light">Tuition Fee </th>
                                    <td><?= $student_fee['tuition_fee']; ?></td>
                                    <th class="bg-light">Examination Fee</th>
                                    <td><?= $student_fee['exam_fee']; ?></td>
                                    <th class="bg-light">Total Fees </th>
                                    <td><?= $student_fee['total_fee']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h5 class="mt-1">Submitted Fee Details</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th class="bg-light">Submitted Tutition Fee</th>
                                    <td><?= $student_fee['submitted_tuition_fee']; ?></td>
                                    <th class="bg-light">Submitted Exam Fee</th>
                                    <td><?= $student_fee['submitted_exam_fee']; ?></td>
                                    <th class="bg-light">Pending Fee</th>
                                    <td><?= $student_fee['pending_fee']; ?></td>

                                </tr>
                                <tr>
                                    <th class="bg-light">Total Submitted Fee</th>
                                    <td><?= $student_fee['total_submitted_fee']; ?></td>
                                    <th class="bg-light"></th>
                                    <td></td>
                                    <th class="bg-light"> Fee Status</th>
                                    <td><?= $student_fee['payment_status']; ?></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Profile Picture Section -->
                <div class="col-md-3 text-center mt-5">
                    <img src="<?= !empty($student['image']) ? $student['image'] : 'uploads/default-avatar.png'; ?>"
                        class="img-fluid border shadow-sm mb-3"
                        alt="Profile Picture" style="max-width: 150px;">
                    <h5 class="fw-bold"><?= $student['name']; ?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card">
            <div class="border-bottom pb-3 mb-3">
                <h4 class="mt-2 text-center"><strong>Submit The Fees</strong></h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="fees">Enter Amount</label>
                            <input type="number" name="submitted_fees" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="type">Fees Type</label>
                            <select name="fees_type" class="form-control" id="">
                                <option value="" selected></option>
                                <option value="tuition_fee">Tuition Fees</option>
                                <option value="exam_fee">Exam Fees</option>
                            </select>
                            <span style="font-size: 10px; color: red;">For Exam Fees Submit Full Amount Of Fees</span>
                        </div>
                        <div class="col-md-4 mb-3 mt-3">
                            <input type="submit" name="submit" value="Submit Fees" class="btn btn-success mt-2">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include("common/footer.php");

?>