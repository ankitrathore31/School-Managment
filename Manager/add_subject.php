<?php  include("common/header.php");

if(isset($_POST['submit'])){
    $subject = $_POST['subject'];

    $query = "insert into subject_tbl(subject)value('$subject')";
    $result = mysqli_query($db, $query);
    if($result){
        echo "<script>alert('Subject Added Successfully');</script>";
    }else{
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
                        Add Subject
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4 mb-3 form-group">
                                <label for="name" class="form-label">Subject Name</label>
                                <input type="text" class="form-control" name="subject">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <input type="submit" value="Add Class" name="submit" class="btn btn-success w-50">
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
                            <th>Subject Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($db, "SELECT * from subject_tbl ");
                        $srno =1;
                        while($data = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                            <td><?php echo $srno++; ?></td>
                            <td><?php echo $data['subject'] ?></td>
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