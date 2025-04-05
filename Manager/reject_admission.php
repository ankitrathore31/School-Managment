<?php include("common/header.php");

?>

<div class="main-content">
    <div class="wrapper">
        <div class="container">
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
                        $query = mysqli_query($db, "SELECT * from students WHERE status = 0 ");
                        $srno = 1;
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?php echo $srno++; ?></td>
                                <td><?php echo $data['student_rollno'] ?></td>
                                <td><?php echo $data['name'] ?></td>
                                <td><img style="max-width: 120px;" src="<?php echo $data['image'] ?>" class="img-fluid" alt="" ></td>
                                <td><?php echo $data['father'] ?></td>
                                <td><?php echo $data['phone'] ?></td>
                                <td><?php echo $data['dob'] ?></td>
                                <td><?php echo $data['class'] ?></td>
                                <td><a href="view_student.php" class="btn btn-sm btn-success me-3"><i class="fa fa-eye"></i></a>                                    <a href="" class="btn btn-sm btn-primary me-3"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-sm btn-danger me-3"><i class="fa fa-trash"></i></a>
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