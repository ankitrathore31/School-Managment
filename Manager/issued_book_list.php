<?php include("common/header.php");

$search_query = "SELECT issued_books.*, students.phone 
                 FROM issued_books 
                 JOIN students ON issued_books.student_id = students.student_id";

$conditions = [];

if (isset($_POST['submit'])) {
    $issue_id = trim($_POST['issue_id']);
    $book_code = trim($_POST['book_code']);
    $student_id = trim($_POST['student_id']);

    if (!empty($issue_id)) {
        $conditions[] = "issued_books.issue_id = '" . mysqli_real_escape_string($db, $issue_id) . "'";
    }
    if (!empty($book_code)) {
        $conditions[] = "issued_books.book_code = '" . mysqli_real_escape_string($db, $book_code) . "'";
    }
    if (!empty($student_id)) {
        $conditions[] = "issued_books.student_id = '" . mysqli_real_escape_string($db, $student_id) . "'";
    }

    if (!empty($conditions)) {
        $search_query .= " WHERE " . implode(" AND ", $conditions);
    }
}
// Execute the query
$result = mysqli_query($db, $search_query);
?>

<div class="main-content">
    <div class="container">
        <div class="card">
            <div class="card-body shadow p-3">
                <form method="post">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="issue_id">Search By Issue ID</label>
                            <input type="number" name="issue_id" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="book_code">Search By Book Code</label>
                            <input type="number" name="book_code" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="student_id">Search By Student ID</label>
                            <input type="text" name="student_id" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3 mt-4">
                            <input type="submit" value="Search" name="submit" class="btn btn-success w-100">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Issued Books</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Issue ID</th>
                        <th>Student ID</th>
                        <th>Phone Number</th>
                        <th>Book Code</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Return Book</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $srno = 1;
                    while ($row = mysqli_fetch_assoc($result)) : 
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
                            <td><?= $srno++; ?></td>
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
                            <td>
                                <a href="book_return.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info me-1">
                                    <i class="fa fa-book me-2"></i>Return
                                </a>
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