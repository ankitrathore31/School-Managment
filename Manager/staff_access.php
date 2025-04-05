<?php include("common/header.php");

if (isset($_POST['submit'])) {
    $staff_position = mysqli_real_escape_string($db, $_POST['staff_position']);

    if (isset($_POST['staff_access']) && !empty($_POST['staff_access'])) {
        $staff_access = implode(",", $_POST['staff_access']); // Convert array to comma-separated string

        // Check if entry for staff_position already exists
        $check_query = "SELECT * FROM staff_access WHERE staff_position = '$staff_position'";
        $check_result = mysqli_query($db, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // If staff position exists, update record
            $update_query = "UPDATE staff_access SET staff_access = '$staff_access' WHERE staff_position = '$staff_position'";
            mysqli_query($db, $update_query);
        } else {
            // If staff position does not exist, insert new record
            $insert_query = "INSERT INTO staff_access (staff_position, staff_access) VALUES ('$staff_position', '$staff_access')";
            mysqli_query($db, $insert_query);
        }

        $userquery = "
        INSERT INTO user (
            staff_access
        ) VALUES (
            '$staff_access'
        )";

        if (mysqli_query($db, $userquery)) {
            echo "<script>alert('User Added Successfully'); window.location.href = 'add_staff.php';</script>";
        } else {
            echo "Error inserting into user table: " . mysqli_error($db);
        }
    }

    echo "<script>alert('Staff Access Added Successfully'); window.location.href = 'staff_access.php';</script>";
}


?>
<style>
    .tag {
        display: inline-flex;
        align-items: center;
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        border-radius: 20px;
        margin: 5px;
        font-size: 14px;
    }

    .tag .remove-btn {
        margin-left: 8px;
        cursor: pointer;
        color: #fff;
        font-weight: bold;
    }

    .tag .remove-btn:hover {
        color: #ccc;
    }

    .tags-container {
        display: flex;
        flex-wrap: wrap;
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        min-height: 48px;
        background-color: #e9ecef;
    }

    .tags-container:empty::before {
        content: "No powers selected";
        color: #6c757d;
    }
</style>
<div class="main-content">
    <!-- Breadcrumb -->
    <div class="row d-flex justify-content-end">
        <div class="col-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Staff Access</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container mt-1">
        <div class="card">
            <div class="border-bottom pb-2 mb-3">
                <h4 class="mb-4 text-center mt-3">Add Staff Powers</h4>
            </div>
            <div class="card-body m-3">
                <form method="post">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="staffPosition" class="label">Select Staff Position:</label>
                            <select id="staffPosition" name="staff_position" class="form-select">
                                <option value="" disabled selected></option>
                                <option value="Principal">Principal</option>
                                <option value="Vice Principal">Vice Principal</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Counselor">Counselor</option>
                                <option value="Librarian">Librarian</option>
                                <option value="Administrative Staff">Administrative Staff</option>
                                <option value="Security">Security</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
    <div class="col-md-6">
        <label for="staff-access">Staff Access</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="staff_access[]" value="Admission" id="admission">
            <label class="form-check-label" for="admission">Admission</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="staff_access[]" value="Fees" id="fees">
            <label class="form-check-label" for="fees">Fees</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="staff_access[]" value="Librarian" id="librarian">
            <label class="form-check-label" for="librarian">Librarian</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="staff_access[]" value="Promote Student" id="promote">
            <label class="form-check-label" for="promote">Promote Student</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="staff_access[]" value="Staff" id="staff">
            <label class="form-check-label" for="staff">Staff</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="staff_access[]" value="Student" id="student">
            <label class="form-check-label" for="student">All Student List</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="staff_access[]" value="Attendance Staff" id="attendance-staff">
            <label class="form-check-label" for="attendance-staff">Attendance Staff</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="staff_access[]" value="Attendance Student" id="attendance-student">
            <label class="form-check-label" for="attendance-student">Attendance Student</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="staff_access[]" value="Examination" id="examination">
            <label class="form-check-label" for="examination">Examination</label>
        </div>
    </div>
</div>

                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <input type="submit" name="submit" value="Add Access" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Display Staff Access List -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Staff Position</th>
                    <th>Access</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM staff_access";
                $result = mysqli_query($db, $query);
                $count = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>{$count}</td>
                    <td>{$row['staff_position']}</td>
                    <td>{$row['staff_access']}</td>
                  </tr>";
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const staffPowerSelect = document.getElementById("staff-access");
    const selectedPowersContainer = document.getElementById("selected-access");

    staffPowerSelect.addEventListener("click", (event) => {
        const selectedOption = event.target;

        // Ensure the clicked element is an option
        if (selectedOption.tagName === "OPTION") {
            const value = selectedOption.value;
            const text = selectedOption.text;

            // Check if the power is already added
            if (!document.querySelector(`.tag[data-value="${value}"]`)) {
                const tag = document.createElement("div");
                tag.className = "tag";
                tag.dataset.value = value;
                tag.innerHTML = `${text} <span class="remove-btn">&times;</span>`;

                // Add remove functionality
                tag.querySelector(".remove-btn").addEventListener("click", () => {
                    tag.remove();
                });

                selectedPowersContainer.appendChild(tag);
            }
        }
    });
</script>

<?php include("common/footer.php");
?>