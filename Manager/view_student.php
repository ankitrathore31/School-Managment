<?php
include("common/header.php");


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);


    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Student not found');</script>";
        exit();
    }
}
?>
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #printcard,
        #printcard * {
            visibility: visible;
        }

        #printcard {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            padding: 10px;
            margin: 0;
            box-shadow: none;
        }

        .no-print {
            display: none !important;
        }

        /* Ensure tables take full width */
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            /* Reduce font size if needed */
        }

        /* Limit image size for print */
        img {
            max-width: 80px;
            /* Reduce image width */
            max-height: 80px;
            display: block;
            margin: 0 auto;
        }

        /* Ensure a page break before new sections */
        .page-break {
            page-break-before: always;
        }

        /* Make sure text fits well */
        h4,
        h5 {
            text-align: center;
            font-size: 14px;
        }

        /* Reduce padding/margins to fit on one page */
        .container {
            padding: 5px;
            margin: 0;
        }

        /* Flexbox to align image and text properly */
        .row {
            display: flex;
            flex-wrap: nowrap;
        }

        .col-md-9 {
            width: 75%;
        }

        .col-md-3 {
            width: 25%;
            text-align: center;
        }
    }
</style>

<div class="main-content">
    <button onclick="printCard()" class="btn btn-primary no-print mb-3">Print</button>
    <div class="container mt-5">
        <div class="card p-3 mb-3 shadow-sm" id="printcard">
            <div class="card-body">
                <div class="row">
                    <!--  Details Section -->
                    <div class="col-md-9">
                        <h4 class="text-center mb-3">Student Details</h4>
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th class="bg-light">Student ID</th>
                                    <td><?= $student['student_id']; ?></td>
                                    <th class="bg-light">Class</th>
                                    <td><?= $student['class']; ?></td>

                                </tr>
                                <tr>
                                    <th class="bg-light">Roll No</th>
                                    <td><?= $student['student_rollno']; ?></td>
                                    <th class="bg-light">Date of Birth</th>
                                    <td><?= $student['dob']; ?></td>

                                </tr>
                                <tr>
                                    <th class="bg-light">Gender</th>
                                    <td><?= $student['gender']; ?></td>

                                    <th class="bg-light">Phone Number</th>
                                    <td><?= $student['phone']; ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Email</th>
                                    <td><?= $student['email']; ?></td>
                                    <th class="bg-light">Enrollment Date</th>
                                    <td><?= $student['enrollment_date']; ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Religion</th>
                                    <td><?= $student['religion']; ?></td>
                                    <th class="bg-light">Religion Category </th>
                                    <td><?= $student['religion_category']; ?></td>

                                </tr>
                                <tr>
                                    <th class="bg-light">Caste </th>
                                    <td><?= $student['caste']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Profile Picture Section -->
                    <div class="col-md-3 text-center mt-5">
                        <img src="<?= !empty($student['image']) ? $student['image'] : 'uploads/default-avatar.png'; ?>"
                            class="img-fluid border shadow-sm mb-3"
                            alt="Profile Picture" width="150">
                        <!-- <p>Name:</p> -->
                        <h5 class="fw-bold"><?= $student['name']; ?></h5>
                    </div>
                
                    <!-- Parent & Guardian Information -->
                    <h5 class="mt-3">Parent & Guardian Information</h5>
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <th class="bg-light">Father's Name</th>
                                <td><?= $student['father']; ?></td>
                                <th class="bg-light">Mother's Name</th>
                                <td><?= $student['mother']; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Guardian Phone</th>
                                <td><?= $student['guardian_phone']; ?></td>
                                <th class="bg-light">Guardian Occupation</th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Address Details -->
                    <h5 class="mt-3">Address Details</h5>
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <th class="bg-light">Nationality</th>
                                <td><?= $student['country']; ?></td>
                                <th class="bg-light">State</th>
                                <td><?= $student['state']; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Home Town</th>
                                <td><?= $student['hometown']; ?></td>
                                <th class="bg-light">District</th>
                                <td><?= $student['district']; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Pincode</th>
                                <td><?= $student['pincode']; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Academic Information -->
                    <h5 class="mt-3">Academic Information</h5>
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <th class="bg-light">Subjects</th>
                                <td><?= $student['subject']; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Password</th>
                                <td><?= $student['password']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printCard() {
        var printContents = document.getElementById("printcard").innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>

<?php include("common/footer.php"); ?>