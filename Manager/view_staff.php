<?php
include("common/header.php");


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);


    $query = "SELECT * FROM staff WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $staff = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Staff not found');</script>";
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
        }

        /* Ensure images are properly scaled */
        img {
            max-width: 100px;
            height: auto;
        }

        /* Center align headings */
        h4,
        h5 {
            text-align: center;
        }

        /* Ensure a page break before new sections */
        .page-break {
            page-break-before: always;
        }
    }
</style>
<div class="main-content">
    <div class="container mt-5">
        <button onclick="printCard()" class="btn btn-primary no-print mb-3">Print</button>
        <div class="card p-3 mb-3 shadow-sm" id="printcard">
            <div class="card-body">
                <div class="row">
                    <!--  Details Section -->
                    <div class="col-md-9">
                        <h4 class="text-center mb-3">Staff Details</h4>
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th class="bg-light">Application Date</th>
                                    <td><?= $staff['application_date']; ?></td>
                                    <th class="bg-light">Appointment Date</th>
                                    <td><?= $staff['appointment_date']; ?></td>


                                </tr>
                                <tr>
                                    <th class="bg-light">Staff Code</th>
                                    <td><?= $staff['staff_code']; ?></td>
                                    <th class="bg-light">Staff Name</th>
                                    <td><?= $staff['name']; ?></td>


                                </tr>
                                <tr>
                                    <th class="bg-light">Date of Birth</th>
                                    <td><?= $staff['dob']; ?></td>
                                    <th class="bg-light">Gender</th>
                                    <td><?= $staff['gender']; ?></td>


                                </tr>
                                <tr>
                                    <th class="bg-light">Phone Number</th>
                                    <td><?= $staff['phone']; ?></td>
                                    <th class="bg-light">Email</th>
                                    <td><?= $staff['email']; ?></td>

                                </tr>
                                <tr>
                                    <th class="bg-light">Religion</th>
                                    <td><?= $staff['religion']; ?></td>
                                    <th class="bg-light">Religion Category </th>
                                    <td><?= $staff['religion_category']; ?></td>

                                </tr>
                                <tr>
                                    <th class="bg-light">Caste </th>
                                    <td><?= $staff['caste']; ?></td>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Profile Picture Section -->
                    <div class="col-md-3 text-center mt-5">
                        <img src="<?= !empty($staff['image']) ? $staff['image'] : 'uploads/default-avatar.png'; ?>"
                            class="img-fluid border shadow-sm mb-3"
                            alt="Profile Picture" width="150">
                        <!-- <p>Name:</p> -->
                        <h5 class="fw-bold"><?= $staff['name']; ?></h5>
                    </div>
                    <!-- Parent & Guardian Information -->
                    <h5 class="mt-3">Parent & Guardian Information</h5>
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <th class="bg-light">Father's Name</th>
                                <td><?= $staff['father']; ?></td>
                                <th class="bg-light">Mother's Name</th>
                                <td><?= $staff['mother']; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Guardian Phone</th>
                                <td></td>
                                <th class="bg-light">Guardian Occupation</th>
                                <td><?= $staff['guardian_occupation']; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Address Details -->
                    <h5 class="mt-3">Address Details</h5>
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <tr>
                                <th class="bg-light">Nationality</th>
                                <td><?= $staff['nationality']; ?></td>
                                <th class="bg-light">State</th>
                                <td><?= $staff['state']; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">District</th>
                                <td><?= $staff['district']; ?></td>
                                <th class="bg-light">Home Town</th>
                                <td><?= $staff['address']; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Pincode</th>
                                <td><?= $staff['pincode']; ?></td>
                                <th></th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Academic Information -->
                    <h5 class="mt-3">Other Information</h5>
                    <table class="table table-bordered table-sm">
                        <tbody>
                            <!-- <tr>
                                <th class="bg-light">Subjects</th>
                                <td></td>
                            </tr> -->
                            <tr>
                                <th class="bg-light">Staff Position</th>
                                <td><?= $staff['staff_position']; ?></td>
                                <th class="bg-light">Password</th>
                                <td><?= $staff['staff_password']; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Staff ID</th>
                                <td><?= $staff['identity_type']; ?></td>
                                <th class="bg-light">Identity No:</th>
                                <td><?= $staff['identity_no']; ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Staff Qualification</th>
                                <td><?= $staff['qualification']; ?></td>
                                <th class="bg-light">Staff Degree:</th>
                                <td><?= $staff['degree']; ?></td>

                            </tr>
                            <tr>
                                <th class="bg-light">Staff Experience:</th>
                                <td><?= $staff['experience_year']; ?> Y</td>
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
        location.reload(); // Refresh the page after printing
    }
</script>



<?php include("common/footer.php"); ?>