<?php
include("common/header.php");

$search_query = "SELECT * FROM staff";
if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $staff_code = isset($_POST['staff_code']) ? trim($_POST['staff_code']) : '';

    $search_query .= " WHERE 1=1"; // Start with WHERE clause

    if (!empty($name)) {
        $search_query .= " AND name LIKE '%" . mysqli_real_escape_string($db, $name) . "%'";
    }
    if (!empty($staff_code)) {
        $search_query .= " AND staff_code = '" . mysqli_real_escape_string($db, $staff_code) . "'";
    }
}

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
                                <label for="student_rollno">Search By Staff Code.</label>
                                <input type="text" name="staff_code" class="form-control">
                            </div>
                            <!-- <div class="col-md-3 form-group mb-3">
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
                            </div> -->
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
                            <th>Staff Code</th>
                            <th>Staff Name</th>
                            <th>Image</th>
                            <th>Gender</th>
                            <th>Father Name</th>
                            <th>Phone</th>
                            <th>DOB</th>
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
                                <td><?= $data['staff_code']; ?></td>
                                <td class="fw-bold"><?= $data['name']; ?></td>
                                <td>
                                    <img src="<?= !empty($data['image']) ? $data['image'] : 'uploads/default-avatar.png'; ?>"
                                        class="img-thumbnail rounded-circle" style="max-width: 60px; height: 60px;" alt="Staff Image">
                                </td>
                                <td><?= $data['gender']; ?></td>
                                <td><?= $data['father']; ?></td>
                                <td><?= $data['phone']; ?></td>
                                <td><?= date('d-m-Y', strtotime($data['dob'])); ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="view_staff.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-success me-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="edit_staff.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-primary me-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="delete_staff.php?id=<?= $data['id']; ?>"
                                            class="btn btn-sm btn-danger me-1" onclick="return confirm('Are you sure you want to delete this staff member?');">
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