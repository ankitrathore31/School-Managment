<?php
include("common/header.php");

// Issue book functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['issue_book'])) {
    $student_id = $_POST['student_id'];
    $book_code = $_POST['book_code'];

    // Verify if student exists
    $studentQuery = "SELECT * FROM students WHERE student_id = '$student_id'";
    $studentResult = mysqli_query($db, $studentQuery);
    $studentExists = mysqli_fetch_assoc($studentResult);

    if (!$studentExists) {
        echo "<div class='main-content'>
                <div class='alert alert-danger' id='error-message'>Invalid Student ID! Please enter a valid ID.</div>
              </div>
              <script>
                setTimeout(function() {
                    document.getElementById('error-message').style.display = 'none';
                }, 4000);
              </script>";
    } else {
        // Check book availability
        $query = "SELECT * FROM books WHERE book_code = '$book_code'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row && $row['book_quantity'] > 0) {
            // Issue book
            $issue_date = date('Y-m-d');
            $insertQuery = "INSERT INTO issued_books (student_id, book_code, issue_date, status) 
                            VALUES ('$student_id', '$book_code', '$issue_date', 'issued')";
            mysqli_query($db, $insertQuery);

            // Reduce book quantity
            $updateQuery = "UPDATE books SET book_quantity = book_quantity - 1 WHERE book_code = '$book_code'";
            mysqli_query($db, $updateQuery);

            echo "<div class='main-content'>
                    <div class='alert alert-success' id='success-message'>Book issued successfully!</div>
                  </div>
                  <script>
                    setTimeout(function() {
                        document.getElementById('success-message').style.display = 'none';
                    }, 4000);
                  </script>";
        } else {
            echo "<div class='main-content'>
                    <div class='alert alert-danger' id='error-message'>Book Not Available!</div>
                  </div>
                  <script>
                    setTimeout(function() {
                        document.getElementById('error-message').style.display = 'none';
                    }, 4000);
                  </script>";
        }
    }
}


// Overdue book check and fine calculation
$today = date('Y-m-d');
$fine_per_day = 5;

$query = "SELECT issued_books.*, students.phone, DATEDIFF('$today', issue_date) AS days_issued 
          FROM issued_books 
          JOIN students ON issued_books.student_id = students.student_id 
          WHERE issued_books.status = 'issued'";

$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['days_issued'] > 7) {
        $overdue_days = $row['days_issued'] - 7;
        $fine = $overdue_days * $fine_per_day;

        // Notify student via SMS (Implement SMS API here)
        $mobile = $row['phone'];
        $message = "Your book is overdue by $overdue_days days. Your fine is $fine rupees.";
        // send_sms($mobile, $message); // Uncomment when SMS API is implemented

        // Mark as overdue
        $updateQuery = "UPDATE issued_books SET status = 'overdue' WHERE issue_id = {$row['issue_id']}";
        mysqli_query($db, $updateQuery);
    }
}




// Return book functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['return_book'])) {
    $issue_id = $_POST['issue_id'];
    $return_date = date('Y-m-d');

    // Update return status
    $updateQuery = "UPDATE issued_books SET return_date='$return_date', status='returned' WHERE issue_id='$issue_id'";
    mysqli_query($db, $updateQuery);

    // Increase book quantity
    $bookQuery = "SELECT book_code FROM issued_books WHERE issue_id='$issue_id'";
    $bookResult = mysqli_query($db, $bookQuery);
    $bookRow = mysqli_fetch_assoc($bookResult);

    if ($bookRow) {
        $book_code = $bookRow['book_code'];
        $updateBookQuery = "UPDATE books SET book_quantity = book_quantity + 1 WHERE book_code = '$book_code'";
        mysqli_query($db, $updateBookQuery);
    }

    echo "<div class='main-content'>
        <div class='alert alert-success' id='success-message'>Book Returned successfully!</div>
        </div>
        <script>
          setTimeout(function() {
              document.getElementById('success-message').style.display = 'none';
          }, 4000); // 5000 milliseconds = 5 seconds
        </script>";
}
?>

<div class="main-content">
    <div class="container mt-4">
        <div class="row">
            <!-- Issue a Book -->
            <div class="col-md-6">
                <div class="card shadow-lg rounded-3">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Issue a Book</h2>
                        <form method="post">
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student ID:</label>
                                <input type="text" name="student_id" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="book_code" class="form-label">Book Code:</label>
                                <input type="text" name="book_code" class="form-control" required>
                            </div>
                            <button type="submit" name="issue_book" class="btn btn-primary w-100">Issue Book</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Return a Book -->
            <div class="col-md-6">
                <div class="card shadow-lg rounded-3">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Return a Book</h2>
                        <form method="post">
                            <div class="mb-3">
                                <label for="issue_id" class="form-label">Issue ID:</label>
                                <input type="text" name="issue_id" class="form-control" required>
                            </div>
                            <button type="submit" name="return_book" class="btn btn-success w-100">Return Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
</div>


<?php include("common/footer.php"); ?>