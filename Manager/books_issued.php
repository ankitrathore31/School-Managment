<?php
include("common/header.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
        $book_code_value = $book['book_code']; // Assign book code if found
    } else {
        echo "<script>alert('Book not found');</script>";
        exit();
    }
} else {
    $book_code_value = ''; // Default value if id is not present
}

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
        // Get student phone
        $phone = $studentExists['phone'];

        // Check book availability
        $query = "SELECT * FROM books WHERE book_code = '$book_code'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row && $row['book_quantity'] > 0) {
            // Check if book already issued to student and not returned
            $checkIssuedQuery = "SELECT * FROM issued_books 
                                 WHERE student_id = '$student_id' 
                                 AND book_code = '$book_code' 
                                 AND status IN ('issued', 'overdue')";
            $alreadyIssuedResult = mysqli_query($db, $checkIssuedQuery);

            if (mysqli_num_rows($alreadyIssuedResult) > 0) {
                echo "<div class='main-content'>
                        <div class='alert alert-warning' id='error-message'>This book is already issued to this student!</div>
                      </div>
                      <script>
                        setTimeout(function() {
                            document.getElementById('error-message').style.display = 'none';
                        }, 4000);
                      </script>";
            } else {
                // Issue book
                $issue_date = date('Y-m-d');
                $issue_id = rand(1000, 999999); // Random 4–6 digit issue ID

                $insertQuery = "INSERT INTO issued_books (issue_id, student_id, phone, book_code, issue_date, status) 
                                VALUES ('$issue_id', '$student_id', '$phone', '$book_code', '$issue_date', 'issued')";
                mysqli_query($db, $insertQuery);

                // Reduce book quantity
                $updateQuery = "UPDATE books SET issue_quantity = issue_quantity - 1 WHERE book_code = '$book_code'";
                mysqli_query($db, $updateQuery);

                echo "<div class='main-content'>
                        <div class='alert alert-success' id='success-message'>Book issued successfully!</div>
                      </div>
                      <script>
                        setTimeout(function() {
                            document.getElementById('success-message').style.display = 'none';
                        }, 4000);
                      </script>";
            }
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


?>

<div class="main-content">
<div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">

                        <div>Book Status: <?= $book['book_status']; ?></div>
                    </div>

                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">

                        <div>Book Name: <?= $book['book_name']; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">

                        <div>Book Code: <?= $book['book_code']; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">

                        <div>Book Writter: <?= $book['book_writter']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <!-- Issue a Book -->
            <div class="col-md-12 mb-3">
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
                                <input type="text" name="book_code" value="<?= htmlspecialchars($book_code_value); ?>" class="form-control" required>
                            </div>
                            <button type="submit" name="issue_book" class="btn btn-primary w-100">Issue Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<?php include("common/footer.php"); ?>