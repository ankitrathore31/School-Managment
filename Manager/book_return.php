<?php include("common/header.php");


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT * FROM issued_books WHERE id = $id";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
        $book_id_value = $book['issue_id']; // Assign book id if found
    } else {
        echo "<script>alert('Book ID not found');</script>";
        exit();
    }
} else {
    $book_id_value = ''; // Default value if id is not present
}

// Return book functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['return_book'])) {
    $issue_id = $_POST['issue_id'];
    $return_date = date('Y-m-d');

    // Check current status
    $statusQuery = "SELECT status, book_code FROM issued_books WHERE issue_id = '$issue_id'";
    $statusResult = mysqli_query($db, $statusQuery);
    $statusRow = mysqli_fetch_assoc($statusResult);

    if ($statusRow) {
        if ($statusRow['status'] === 'returned') {
            echo "<div class='main-content'>
                    <div class='alert alert-warning' id='error-message'>This book has already been returned!</div>
                  </div>
                  <script>
                    setTimeout(function() {
                        document.getElementById('error-message').style.display = 'none';
                    }, 4000);
                  </script>";
        } else {
            // Proceed with return
            $updateQuery = "UPDATE issued_books SET return_date='$return_date', status='returned' WHERE issue_id='$issue_id'";
            mysqli_query($db, $updateQuery);

            // Increase book quantity
            $book_code = $statusRow['book_code'];
            $updateBookQuery = "UPDATE books SET issue_quantity = issue_quantity + 1 WHERE book_code = '$book_code'";
            mysqli_query($db, $updateBookQuery);

            echo "<div class='main-content'>
                    <div class='alert alert-success' id='success-message'>Book returned successfully!</div>
                  </div>
                  <script>
                    setTimeout(function() {
                        document.getElementById('success-message').style.display = 'none';
                    }, 4000);
                  </script>";
        }
    } else {
        echo "<div class='main-content'>
                <div class='alert alert-danger' id='error-message'>Invalid issue ID!</div>
              </div>
              <script>
                setTimeout(function() {
                    document.getElementById('error-message').style.display = 'none';
                }, 4000);
              </script>";
    }
}

?>
<div class="main-content">


    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">

                        <div>Student ID: <?= $book['student_id']; ?></div>
                    </div>

                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">

                        <div>Issue ID: <?= $book['issue_id']; ?></div>
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

                        <div>Issue Date: <?= $book['issue_date']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="row">
            <!-- Return a Book -->
            <div class="col-md-12">
                <div class="card shadow-lg rounded-3">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Return a Book</h2>
                        <form method="post">
                            <div class="mb-3">
                                <label for="issue_id" class="form-label">Issue ID:</label>
                                <input type="text" name="issue_id" value="<?= htmlspecialchars($book_id_value); ?>" class="form-control" required>
                            </div>
                            <button type="submit" name="return_book" class="btn btn-success w-100">Return Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("common/footer.php");

?>