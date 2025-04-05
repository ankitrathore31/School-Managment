<?php include("common/header.php");

?>

<div class="main-content">
    <div id="printcontent" class="container mt-4">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Period</th>
                            <th>Time</th>
                            <th>Class</th>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Before Interval: 5 Inputs -->
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="text" class="form-control timepicker" name="time[1]" placeholder="Enter Time">
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM class");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['class']; ?>"><?php echo $row['class']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM subject_tbl");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['subject']; ?>"><?php echo $row['subject']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="text" class="form-control timepicker" name="time[1]" placeholder="Enter Time">
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM class");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['class']; ?>"><?php echo $row['class']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM subject_tbl");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['subject']; ?>"><?php echo $row['subject']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <input type="text" class="form-control timepicker" name="time[1]" placeholder="Enter Time">
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM class");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['class']; ?>"><?php echo $row['class']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM subject_tbl");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['subject']; ?>"><?php echo $row['subject']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <input type="text" class="form-control timepicker" name="time[1]" placeholder="Enter Time">
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM class");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['class']; ?>"><?php echo $row['class']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM subject_tbl");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['subject']; ?>"><?php echo $row['subject']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <input type="text" class="form-control timepicker" name="time[1]" placeholder="Enter Time">
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM class");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['class']; ?>"><?php echo $row['class']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="class" id="class_select" class="form-select">
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM subject_tbl");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <option value="<?php echo $row['subject']; ?>"><?php echo $row['subject']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                   
                        <!-- Interval -->
                        <tr>
                            <td colspan="4" class="text-center table-info">
                                <div class="mb-2">
                                    <label for="interval-time" class="form-label">Enter Interval Time</label>
                                    <input type="text" class="form-control w-50 mx-auto" name="interval" id="interval-time" placeholder="12:00 To 01:00">
                                </div>
                            </td>
                        </tr>
                    =
                    </tbody>
                </table>

                <div class="row mt-3">
                    <div class="col-md-9"></div>
                    <div class="col-md-3 text-end">
                        <button type="submit" class="btn btn-primary w-75">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            minTime: '6:00am',
            maxTime: '9:00pm',
            defaultTime: '6:00am',
            startTime: '6:00am',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>


<?php include("common/footer.php");

?>