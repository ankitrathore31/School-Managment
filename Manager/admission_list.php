<?php include("common/header.php");

$search_query = "SELECT * FROM students WHERE status = '' ";

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $student_rollno = trim($_POST['student_rollno']);
    $class = trim($_POST['class']);

    if (!empty($name)) {
        $name = addslashes($name); // Escape special characters
        $search_query .= " AND name LIKE '%$name%'";
    }
    if (!empty($student_rollno)) {
        $student_rollno = addslashes($student_rollno); // Escape special characters
        $search_query .= " AND student_rollno = '$student_rollno'";
    }
    if (!empty($class)) {
        $class = addslashes($class); // Escape special characters
        $search_query .= " AND class = '$class'";
    }
}

// Display results alphabetically by name
$search_query .= " ORDER BY name ASC";

$result = mysqli_query($db, $search_query);

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = intval($_GET['status']);

    // Fetch the student's details
    $student_query = "SELECT class, student_rollno, student_id, name FROM students WHERE id = $id";
    $student_result = mysqli_query($db, $student_query);

    if ($student_result && mysqli_num_rows($student_result) > 0) {
        // Fetch the student's data
        $student_data = mysqli_fetch_assoc($student_result);

        // Ensure keys exist in the result
        if (isset($student_data['class']) && isset($student_data['student_rollno']) && isset($student_data['name'])) {
            $class = $student_data['class'];
            $student_id = $student_data['student_id'];
            $student_rollno = $student_data['student_rollno'];
            $name = $student_data['name'];

            if ($status == 1) { // If admission is approved
                // Fetch fees for the class
                $fees_query = "SELECT tuition_fee, exam_fee FROM fees WHERE class = '$class'";
                $fees_result = mysqli_query($db, $fees_query);

                if ($fees_result && mysqli_num_rows($fees_result) > 0) {
                    $fees_data = mysqli_fetch_assoc($fees_result);
                    $tuition_fee = $fees_data['tuition_fee'];
                    $exam_fee = $fees_data['exam_fee'];

                    // Insert fees into the student_payments table
                    $insert_fees_query = "
                        INSERT INTO student_payments (student_id, student_rollno, name, class, tuition_fee, exam_fee, total_fee,pending_fee, payment_status)
                        VALUES ('$student_id', '$student_rollno', '$name', '$class', $tuition_fee, $exam_fee, ($tuition_fee + $exam_fee), ($tuition_fee + $exam_fee), 'pending')
                    ";

                    $insert_fees_result = mysqli_query($db, $insert_fees_query);

                    // Debugging: Check if the insert query failed
                    if (!$insert_fees_result) {
                        echo "<script>alert('Failed to add fees: " . mysqli_error($db) . "');</script>";
                    }
                } else {
                    echo "<script>alert('Fees not found for class: $class');</script>";
                }
            }

            // Update student status
            $update_status_query = "UPDATE students SET status = $status WHERE id = $id";
            $update_status_result = mysqli_query($db, $update_status_query);

            if ($update_status_result) {
                if ($status == 1) {
                    echo "<script>alert('Admission Approved and Fees Added');</script>";
                } else if ($status == 0) {
                    echo "<script>alert('Admission Rejected');</script>";
                }
            } else {
                echo "<script>alert('Failed to update student status: " . mysqli_error($db) . "');</script>";
            }
        } else {
            echo "<script>alert('Required data missing from the student record.');</script>";
        }
    } else {
        echo "<script>alert('Student not found: " . mysqli_error($db) . "');</script>";
    }
}

?>

<div class="main-content">
    <div class="wrapper">
    <div class="container">
            <div class="card">
                <div class="card-body shadow p-3">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="name">Search By Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="student_rollno">Search By Roll No.</label>
                                <input type="text" name="student_rollno" class="form-control">
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label for="class_select">Search By Class:</label>
                                <select name="class" id="class_select" class="form-control">
                                    <option value="">--Select Class--</option>
                                    <?php
                                    $class_query = "SELECT DISTINCT class FROM class";
                                    $class_result = mysqli_query($db, $class_query);
                                    while ($row = mysqli_fetch_assoc($class_result)) {
                                    ?>
                                        <option value="<?php echo $row['class']; ?>"><?php echo $row['class']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3 mt-4">
                                <input type="submit" value="Search" name="submit" class="btn btn-success w-100 mt-2">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="table-responsive m-3">
                <table class="table border">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Roll No.</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Father Name</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $srno = 1;
                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $srno++; ?></td>
                                <td><?php echo $data['student_rollno'] ?></td>
                                <td><?php echo $data['name'] ?></td>
                                <td><img style="max-width: 120px;" src="<?php echo $data['image'] ?>" class="img-fluid" alt=""></td>
                                <td><?php echo $data['father'] ?></td>
                                <td><?php echo $data['phone'] ?></td>
                                <td><?php echo $data['dob'] ?></td>
                                <td><?php echo $data['class'] ?></td>
                                <td><a href="view_student.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-success me-1"><i class="fa fa-eye"></i></a>
                                    <a href="admission_list.php?id=<?= $data['id']; ?>&status=1" class="btn btn-sm btn-primary me-1 "><i class="fa fa-check text-success text-white"></i></a>
                                    <a href="admission_list.php?id=<?= $data['id']; ?>&status=0" class="btn btn-sm btn-danger me-1"><i class="fa fa-times text-danger text-white"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php
include("common/footer.php");
?>