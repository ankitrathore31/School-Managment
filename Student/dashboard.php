<?php session_start();

include("common/header.php");

$student_id = $_SESSION['student_id'] ?? null;


// Fetch student info
$studentQuery = $db->prepare("SELECT * FROM students WHERE student_id = ?");
$studentQuery->bind_param("s", $student_id);
$studentQuery->execute();
$studentResult = $studentQuery->get_result();
$student = $studentResult->fetch_assoc();


?>
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .graph-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        /* Adjust padding for better spacing */
    }

    .medium-graph {
        height: 80px;
        /* Reduce height for a smaller chart */
        width: 60%;
        /* Reduce width for a balanced look */
    }

    canvas {
        width: 100% !important;
        height: 100% !important;
    }

    .graph-container {
        display: flex;
        flex-direction: column;
        /* Stack title and canvas */
        align-items: center;
        justify-content: center;
        height: 80%;
        /* Ensures full height */
        min-height: 200px;
        /* Adjust this as needed */
    }

    .graph-container canvas {
        width: 80% !important;
        /* Ensures it scales properly */
        height: 100% !important;
        /* Matches parent height */
    }



    .medium-calendar {
        max-width: 450px;
        /* Reduce width for better fit */
        margin: auto;
    }

    #calendar {
        padding: 5px;
        width: 90%;
    }
</style>
<div class="container mt-4">
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card mb-4 shadow rounded-4">
                <div class="card-body">
                    <h3 class="card-title mb-4 text-center">
                        <i class="fas fa-user-graduate me-2 text-primary"></i>
                        Welcome, <?php echo htmlspecialchars($student['name']); ?>
                    </h3>

                    <div class="row">
                        <!-- Personal Info -->
                        <div class="col-md-6 border-end">
                            <h5 class="mb-3 text-secondary">
                                <i class="fas fa-id-card me-2"></i> Personal Information
                            </h5>

                            <p class="card-text">
                                <i class="fas fa-id-badge me-2 text-secondary"></i>
                                <strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?>
                            </p>

                            <p class="card-text">
                                <i class="fas fa-envelope me-2 text-secondary"></i>
                                <strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?>
                            </p>

                            <p class="card-text">
                                <i class="fas fa-user-tie me-2 text-secondary"></i>
                                <strong>Father's Name:</strong> <?php echo htmlspecialchars($student['father']); ?>
                            </p>
                        </div>

                        <!-- Academic Info -->
                        <div class="col-md-6">
                            <h5 class="mb-3 text-secondary">
                                <i class="fas fa-book-open me-2"></i> Academic Information
                            </h5>

                            <p class="card-text">
                                <i class="fas fa-chalkboard me-2 text-secondary"></i>
                                <strong>Class:</strong> <?php echo htmlspecialchars($student['class']); ?>
                            </p>

                            <p class="card-text">
                                <i class="fas fa-calendar-alt me-2 text-secondary"></i>
                                <strong>Enrollment Date:</strong> <?php echo date("d M Y", strtotime($student['enrollment_date'])); ?>
                            </p>

                            <p class="card-text">
                                <i class="fas fa-book me-2 text-secondary"></i>
                                <strong>Subjects:</strong> <?php echo htmlspecialchars($student['subject']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="card p-3 graph-container w-100">
                <h5 class="text-center">Attendance</h5>
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="card p-3 graph-container w-100">
                <h5 class="text-center">Fees</h5>
                <canvas id="feesChart"></canvas>
            </div>
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="text-center">School Calendar</h5>
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [{
                    title: 'Parent-Teacher Meeting',
                    start: '2025-04-10'
                },
                {
                    title: 'Sports Day',
                    start: '2025-04-20'
                },
                {
                    title: 'Exams Begin',
                    start: '2025-05-05'
                }
            ]
        });
        calendar.render();
    });

    new Chart(document.getElementById('attendanceChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                label: 'Attendance (%)',
                data: [95, 90, 85, 92, 88],
                backgroundColor: 'blue'
            }]
        }
    });

    new Chart(document.getElementById('feesChart'), {
        type: 'pie',
        data: {
            labels: ['Paid', 'Due'],
            datasets: [{
                data: [75, 25],
                backgroundColor: ['green', 'red']
            }]
        }
    });
</script>


<?php include("common/footer.php");
?>