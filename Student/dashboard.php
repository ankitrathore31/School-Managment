<?php
session_start();
// if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== 'id') {
//     header("Location: ../Home/stu-login.php");
//     exit;
// }

include("common/header.php");

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
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h5 class="mb-3 text-center"><i class="fas fa-user"></i> Student Information</h5>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6 fw-bold"><i class="fas fa-id-badge"></i> Student ID:</div>
                        <div class="col-6">#12345</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 fw-bold"><i class="fas fa-user"></i> Name:</div>
                        <div class="col-6">John Doe</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 fw-bold"><i class="fas fa-graduation-cap"></i> Class:</div>
                        <div class="col-6">10th Grade</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 fw-bold"><i class="fas fa-list-ol"></i> Roll No:</div>
                        <div class="col-6">25</div>
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


    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card p-3 graph-container">
                <h5>Results</h5>
                <canvas id="resultChart"></canvas>
            </div>
        </div>
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

    new Chart(document.getElementById('resultChart'), {
        type: 'radar',
        data: {
            labels: ['Math', 'Science', 'English', 'History', 'Computer'],
            datasets: [{
                label: 'Marks (%)',
                data: [85, 88, 92, 75, 95],
                backgroundColor: 'rgba(153, 102, 255, 0.5)',
                borderColor: 'purple',
                pointBackgroundColor: 'purple'
            }]
        }
    });
</script>


<?php include("common/footer.php");
?>