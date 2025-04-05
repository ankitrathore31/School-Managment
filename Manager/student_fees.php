<?php
include("common/header.php");

// Handle form submission
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $student_id = trim($_POST['student_id']);
    $class = trim($_POST['class']);

    // Build the SQL query without sanitization (not recommended for production)
    $sql = "SELECT * FROM students WHERE 1=1"; // 1=1 is used to simplify adding conditions dynamically

    if (!empty($name)) {
        $sql .= " AND name LIKE '%$name%'";
    }
    if (!empty($student_id)) {
        $sql .= " AND student_id = '$student_id'";
    }
    if (!empty($class)) {
        $sql .= " AND class = '$class'";
    }

    $result = mysqli_query($db, $sql);
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
                                <label for="student_rollno">Search By ID</label>
                                <input type="text" name="student_id" class="form-control">
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
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-3">
                        <table class="table border">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Roll No.</th>
                                    <th>Name</th>
                                    <th>Father Name</th>
                                    <th>Phone</th>
                                    <th>DOB</th>
                                    <th>Class</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($result) && mysqli_num_rows($result) > 0) {
                                    $srno = 1; // Initialize serial number
                                    while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $srno++; ?></td>
                                            <td><?php echo $data['student_rollno']; ?></td>
                                            <td><?php echo $data['name']; ?></td>
                                            <td><?php echo $data['father']; ?></td>
                                            <td><?php echo $data['phone']; ?></td>
                                            <td><?php echo $data['dob']; ?></td>
                                            <td><?php echo $data['class']; ?></td>
                                            <td>
                                                <a href="payfees.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-success me-3">
                                                    <i class="fas fa-coins me-2"></i> Submit
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("common/footer.php"); ?>