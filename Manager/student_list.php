<?php
include("common/header.php");

$search_query = "SELECT * FROM students WHERE status = 1";
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $student_id = trim($_POST['student_id']);
    $class = trim($_POST['class']);

    $search_query .= " AND 1=1";
    if (!empty($name)) {
        $search_query .= " AND name LIKE '%$name%'";
    }
    if (!empty($student_id)) {
        $search_query .= " AND student_id = '$student_id'";
    }
    if (!empty($class)) {
        $search_query .= " AND class = '$class'";
    }
}

//display results alphabetically by name
$search_query .= " ORDER BY name ASC";

$result = mysqli_query($db, $search_query);
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
                                <label for="student_rollno">Search By Student ID</label>
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
                            <div class="col-md-3 mb-3 mt-3">
                                <input type="submit" value="Search" name="submit" class="btn btn-success w-100 mt-2">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <div class="table-responsive m-1">
                <table class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Student ID</th>
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
                                <td><?= $srno++; ?></td>
                                <td class="fw-bold"><?= $data['student_id']; ?></td>
                                <td><?= $data['student_rollno']; ?></td>
                                <td class="fw-bold"><?= $data['name']; ?></td>
                                <td>
                                    <img src="<?= !empty($data['image']) ? $data['image'] : 'uploads/default-avatar.png'; ?>"
                                        class="img-thumbnail" style="max-width: 80px; height: 80px;" alt="Student Image">
                                </td>
                                <td><?= $data['father']; ?></td>
                                <td><?= $data['phone']; ?></td>
                                <td><?= date('d-m-Y', strtotime($data['dob'])); ?></td>
                                <td class="fw-semibold"><?= $data['class']; ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="view_student.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-success  me-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="edit_student.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-primary me-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="delete_student.php?id=<?= $data['id']; ?>"
                                            class="btn btn-sm btn-danger me-1" onclick="return confirm('Are you sure?');">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
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