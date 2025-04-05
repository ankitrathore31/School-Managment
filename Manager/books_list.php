<?php include("common/header.php");

$search_query = "SELECT * FROM books";
$conditions = []; // Array to store conditions

if (isset($_POST['submit'])) {
    $book_name = trim($_POST['book_name']);
    $book_code = trim($_POST['book_code']);
    $book_writter = trim($_POST['book_writter']);

    if (!empty($book_name)) {
        $conditions[] = "book_name LIKE '%" . mysqli_real_escape_string($db, $book_name) . "%'";
    }
    if (!empty($book_code)) {
        $conditions[] = "book_code = '" . mysqli_real_escape_string($db, $book_code) . "'";
    }
    if (!empty($book_writter)) {
        $conditions[] = "book_writter = '" . mysqli_real_escape_string($db, $book_writter) . "'";
    }
}

// Append conditions to the query if they exist
if (!empty($conditions)) {
    $search_query .= " WHERE " . implode(' AND ', $conditions);
}

// Display results alphabetically by name
$search_query .= " ORDER BY book_name ASC";

// Execute the query
$result = mysqli_query($db, $search_query);

// Check for errors
// if (!$result) {
//     die("Query failed: " . mysqli_error($db));
// }


?>

<div class="wrapper">
    <div class="main-content">
        <div class="container">
            <div class="card">
                <div class="card-body shadow p-3">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="name">Search By Name</label>
                                <input type="text" name="book_name" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="student_rollno">Search By Book Code</label>
                                <input type="number" name="book_code" class="form-control">
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label for="class_select">Search By Writter</label>
                                <input type="text" name="book_writter" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3 mt-3">
                                <input type="submit" value="Search" name="submit" class="btn btn-success w-100 mt-2">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="table-responsive m-3">
                <table class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Book Code</th>
                            <th>Book Name</th>
                            <th>Book Writer</th>
                            <th>Book Quantity</th>
                            <th>Book Available</th>
                            <th>Issue Book</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $srno = 1;
                        while ($data = mysqli_fetch_assoc($result)) {
                            // Assuming 'book_borrowed' is a column in your database that stores borrowed books
                            $available_books = $data['book_quantity'] - ($data['book_borrowed'] ?? 0);
                        ?>
                            <tr>
                                <td><?= $srno++; ?></td>
                                <td><?= $data['book_code']; ?></td>
                                <td class="fw-bold"><?= $data['book_name']; ?></td>
                                <td><?= $data['book_writter']; ?></td>
                                <td class="fw-semibold"><?= $data['book_quantity']; ?></td>
                                <td class="<?= ($book_status = 'Available') ? 'text-success fw-bold' : 'text-danger fw-bold'; ?>">
                                    <?= $book_status; ?>
                                </td>
                                <td>
                                    <a href="books_issued.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-success me-1">
                                        <i class="fa fa-book me-2"></i>Issue
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">

                                        <a href="edit_book.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-primary me-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="delete_book.php?id=<?= $data['id']; ?>"
                                            class="btn btn-sm btn-danger me-1" onclick="return confirm('Are you sure you want to delete this book?');">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include("common/footer.php");

?>