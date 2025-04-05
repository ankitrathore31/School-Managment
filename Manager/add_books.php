<?php 
include("common/header.php");

if (isset($_POST['submit'])) {
    $book_code = $_POST['book_code'];
    $book_name = $_POST['book_name'];
    $book_writter = $_POST['book_writter'];
    $book_quantity = $_POST['book_quantity'];

    $issue_quantity = $book_quantity;
    $book_status = ($issue_quantity == 0) ? 'Unavailable' : 'Available';

    $query = "INSERT INTO books (book_code, book_name, book_writter, book_quantity, issue_quantity, book_status)
              VALUES ('$book_code', '$book_name', '$book_writter', '$book_quantity', '$issue_quantity', '$book_status')";
              
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "<script>alert('Book Added Successfully');</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}


?>

<div class="wrapper">
    <div class="main-content">
        <div class="container mt-5">
            <div class="card">
                <div class="border-bottom pb-3 mb-3">
                    <h4 class="text-center mt-2"><strong>Add Books For Library</strong></h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="code">Book Code</label>
                                <input type="number" name="book_code" class="form-control">
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="">Book Name</label>
                                <input type="text" name="book_name" class="form-control">
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="writter">Book Writter</label>
                                <input type="text" name="book_writter" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="quantity">Book Quantity</label>
                                <input type="number" name="book_quantity" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <input type="submit" name="submit" class="btn btn-success mt-3" value="Add Book">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include("common/footer.php");
?>