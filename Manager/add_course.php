<?php 
include("common/header.php");
?>

<div class="main-content">
    <div class="wrapper">
        <div class="container">
            <div class="card shadow m-3">
                <div class="card-header">
                    <div class="card-title text-center">
                        Add Course
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4 mb-3 form-group">
                                <label for="name" class="form-label">Course Name</label>
                                <input type="text" class="form-control" name="course_name">
                            </div>
                            <div class="col-md-4 mb-3 form-group">
                                <label for="name" class="form-label">Class</label>
                                <input type="text" class="form-control" name="course_name">
                            </div>
                            <div class="col-md-4 mb-3 form-group">
                                <label for="name" class="form-label">Subject</label>
                                <input type="text" class="form-control" name="course_name">
                            </div>
                        </div>
                        <div class="row"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include("common/footer.php");
?>