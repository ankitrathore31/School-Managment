<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'manager') {
    header("Location: ../Home/login.php");
    exit;
}
include("common/header.php");

$query = "SELECT gender, COUNT(*) as count FROM students GROUP BY gender";
$result = mysqli_query($db, $query);

// Prepare data for the graph
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['gender']] = $row['count'];
}

while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['id']] = $row['count'];
}

// Default values if no data exists
$male_count = isset($data['Male']) ? $data['Male'] : 0;
$female_count = isset($data['Female']) ? $data['Female'] : 0;

$student_count = isset($data['id']) ? $data['id'] : 0;

?>
<style>
    .card {
        border: none;
        border-radius: 8px;
        padding: 15px;
    }

    .card .icon {
        font-size: 24px;
        color: #fff;
        margin-right: 10px;
    }

    .card .info-text {
        font-size: 14px;
        color: #fff;
        margin: 0;
    }

    .card h4 {
        margin: 5px 0 0;
        font-size: 16px;
        color: #fff;
        font-weight: 600;
    }

    .card h5 {
        font-size: 20px;
        color: #fff;
        font-weight: 700;
        margin: 0;
    }

    .dashboard-row {
        gap: 5px;
    }
    .chart-container {
        width: 100%;
        height: 400px; /* Fixed height to match both charts */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    canvas {
        max-width: 100% !important;
        max-height: 100% !important;
    }
</style>
<div class="main-content">
    <div class="wrapper">
        <div class="card shadow">
            <div class="card-body">
                <div class="row dashboard-row justify-content-between">
                    <!-- Total Student -->
                    <div class="col-md-2 col-sm-6 mb-3">
                        <div class="card bg-success">
                            <i class="fas fa-user icon"></i>
                            <div>
                                <p class="info-text">Total Students</p>
                                <?php
                                $query = mysqli_query($db, "SELECT * FROM students WHERE status = 1");
                                $total_student = mysqli_num_rows($query);
                                echo "<h5>" . $total_student . "</h5>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Total Staff -->
                    <div class="col-md-2 col-sm-6 mb-3">
                        <div class="card bg-primary d-flex ">
                            <i class="fas fa-users icon"></i>
                            <div>
                                <p class="info-text">Total Staff</p>
                                <?php
                                $query = mysqli_query($db, "SELECT * FROM staff");
                                $total_staff = mysqli_num_rows($query);
                                echo "<h5>" . $total_staff . "</h5>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Total Fees -->
                    <div class="col-md-2 col-sm-6 mb-3">
                        <div class="card bg-warning d-flex ">
                            <i class="fas fa-dollar-sign icon"></i>
                            <div>
                                <p class="info-text">Total Fees</p>
                                <h5>0</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 mb-3">
                        <div class="card bg-info text-white ">
                            <!-- <div class="card-body text-center"> -->
                            <i class="fa fa-book-open"></i>
                            <!-- <h4>Total Subject</h4> -->
                            <div>
                                <p class="info-text">Total Subject</p>
                                <?php $query = mysqli_query($db, "SELECT * FROM subject_tbl");
                                $total_subject = mysqli_num_rows($query);
                                echo "<h5>" . $total_subject . "</h5>";
                                ?>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 mb-3">
                        <div class="card bg-secondary text-white">
                            <!-- <div class="card-body text-center"> -->
                            <i class="fa fa-chalkboard-teacher"></i>
                            <!-- <h4>Total Class</h4> -->
                            <div>
                                <p class="info-text">Total Class</p>
                                <?php $query = mysqli_query($db, "SELECT * FROM class");
                                $total_class = mysqli_num_rows($query);
                                echo "<h5>" . $total_class . "</h5>"; ?>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="row">
                <!-- Student Gender Chart -->
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header text-center">
                            <h5 class="text-black">Student Male Female</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height: 100%;">
                                <canvas id="genderChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Admissions Chart -->
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header text-center">
                            <h5 class="text-black">Student Admissions per Year</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height: 100%;">
                                <canvas id="admissionsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    // Gender Chart Data
    const maleCount = <?php echo $male_count; ?>;
    const femaleCount = <?php echo $female_count; ?>;
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'pie',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [maleCount, femaleCount],
                backgroundColor: ['green', 'blue']
            }]
        }
    });

    // Admissions Chart Data
    const stuCount = <?php echo $student_count; ?>;
    const admissionsData = {
        labels: ["2023", "2024", "2025"], // Replace with dynamic years from PHP
        datasets: [{
            label: 'Student Admissions',
            data: [80, 65, stuCount], // Replace with dynamic PHP data
            backgroundColor: 'rgba(75, 192, 192, 0.4)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
            pointBorderColor: 'rgba(54, 162, 235, 1)',
            pointRadius: 4
        }]
    };

    // Admissions Chart Configuration
    const config = {
        type: 'line',
        data: admissionsData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Student Admissions (2024-2025)'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Students'
                    },
                    beginAtZero: true
                }
            }
        }
    };

    // Render Admissions Chart
    const chartCanvas = document.getElementById('admissionsChart').getContext('2d');
    new Chart(chartCanvas, config);
</script>

<?php
include("common/footer.php");
?>