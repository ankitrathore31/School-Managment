<?php  session_start();
include("common/header.php");
   

$student_id = $_SESSION['student_id'] ?? null;


// Fetch student info
// $studentQuery = $db->prepare("SELECT * FROM students WHERE student_id = ?");
// $studentQuery->bind_param("s", $student_id);
// $studentQuery->execute();
// $studentResult = $studentQuery->get_result();
// $student = $studentResult->fetch_assoc();

// Fetch issued books
$issuedQuery = $db->prepare("SELECT * FROM issued_books WHERE student_id = ?");
$issuedQuery->bind_param("s", $student_id);
$issuedQuery->execute();
$issuedResult = $issuedQuery->get_result();
?>


<div class="container mt-5">
  
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Issued Books</h4>
    </div>
    <div class="card-body">
      <?php if ($issuedResult->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>Student ID</th>
              <th>Book ID</th>
              <th>Book code</th>
              <th>Issue Date</th>
              <!-- <th>Due Date</th> -->
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $issuedResult->fetch_assoc()): ?>
              <tr>
              <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                <td><?php echo htmlspecialchars($row['issue_id']); ?></td>
                <td><?php echo htmlspecialchars($row['book_code']); ?></td>
                <td><?php echo htmlspecialchars($row['issue_date']); ?></td>
                <!-- <td><?php echo htmlspecialchars($row['due_date']); ?></td> -->
                <td><?php echo htmlspecialchars($row['status']); ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p class="text-muted">No books issued currently.</p>
      <?php endif; ?>
    </div>
  </div>
</div>


<?php include("common/footer.php");

?>
