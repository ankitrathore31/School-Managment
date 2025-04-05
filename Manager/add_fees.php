<?php include("common/header.php");

if (isset($_POST['submit'])) {
    $tution_fee = $_POST['tution_fee'];
    $exam_fee = $_POST['exam_fee'];
    $class = $_POST['class'];

    $query = "insert into fees(tution_fee,exam_fee,class)value('$tution_fee','$exam_fee','$class')";
    $result = mysqli_query($db, $query);
    if ($result) {
        echo "<script>alert('Fees Added Successfully');window.loction.href(add_fees.php);</script>";
    } else {
        echo "<script>alert('Error'); window.history.back();</script>";
    }
}
?>

<div class="main-content">
    <div class="wrapper">
        <div class="container">
            <div class="card shadow m-3">
                <div class="card-header">
                    <div class="card-title text-center">
                        Add Fees
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4 mb-3 form-group">
                                <label for="name" class="form-label">Tution Fees</label>
                                <input type="text" name="tution_fee" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3 form-group">
                                <label for="name" class="form-label">Exam Fees</label>
                                <input type="text" name="exam_fee" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3 form-group">
                                <label for="class_select" class="form-label">Select Class:</label>
                                <select name="class" id="class_select" class="form-control">
                                    <option value="" selected>--Select Class--</option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM class");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['class']; ?>"><?php echo $row['class']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <input type="submit" value="Add Fees" name="submit" class="btn btn-success w-50">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="table-responsive m-3">
                <table class="table border">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Tution Fees</th>
                            <th>Exam Fees</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($db, "SELECT * from fees ");
                        $srno = 1;
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?php echo $srno++; ?></td>
                                <td><?php echo $data['tuition_fee'] ?></td>
                                <td><?php echo $data['exam_fee'] ?></td>
                                <td><?php echo $data['class'] ?></td>
                                <td><a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
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