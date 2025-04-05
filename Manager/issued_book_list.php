<?php include("common/header.php");

// Fetch issued books with student phone numbers
$query = "SELECT issued_books.*, students.phone 
          FROM issued_books 
          JOIN students ON issued_books.student_id = students.student_id";

$result = mysqli_query($db, $query);
?>

<div class="main-content">
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Issued Books</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Issue ID</th>
                        <th>Student ID</th>
                        <th>Phone Number</th>
                        <th>Book Code</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <?php
                        // Check if overdue
                        $issue_date = strtotime($row['issue_date']);
                        $due_date = strtotime($row['issue_date'] . ' +7 days');
                        $current_date = time();

                        if ($row['status'] == 'issued' && $current_date > $due_date) {
                            $row['status'] = 'overdue';
                        }

                        // Define Bootstrap badge colors
                        $status_colors = [
                            'issued' => 'warning',
                            'overdue' => 'danger',
                            'returned' => 'success'
                        ];
                        $status_color = $status_colors[$row['status']] ?? 'secondary';
                        ?>
                        <tr>
                            <td><?= $row['issue_id'] ?></td>
                            <td><?= $row['student_id'] ?></td>
                            <td><?= $row['phone'] ?></td>
                            <td><?= $row['book_code'] ?></td>
                            <td><?= date("d-M-Y", strtotime($row['issue_date'])) ?></td>
                            <td><?= $row['return_date'] ? date("d-M-Y", strtotime($row['return_date'])) : '<span class="text-danger fw-bold">Not Returned</span>' ?></td>
                            <td>
                                <span class="badge bg-<?= $status_color ?>">
                                    <?= ucfirst($row['status']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("common/footer.php");

?>