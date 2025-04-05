<?php
include("common/header.php");

$totalBooks = $db->query("SELECT COUNT(*) as total FROM books")->fetch_assoc()['total'];

$totalQty = $db->query("SELECT SUM(book_quantity) as qty FROM books")->fetch_assoc()['qty'];

$issued = $db->query("SELECT COUNT(*) as total FROM issued_books WHERE return_date IS NULL")->fetch_assoc()['total'];

$returned = $db->query("SELECT COUNT(*) as total FROM issued_books WHERE return_date IS NOT NULL")->fetch_assoc()['total'];

$students = $db->query("SELECT COUNT(*) as total FROM students WHERE status = '1' ")->fetch_assoc()['total'];
?>

<div class="main-content">
    <div class="container mt-4">

        <div class="row text-center">

            <div class="col-md-3 mb-3">
                <div class="card bg-light">
                    <a href="books_list.php" class="btn">
                        <div class="card-body">
                            <i class="fa fa-book fa-2x mb-2"></i>
                            <h5>Total Books</h5>
                            <h3 id="totalBooks">0</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card bg-light">
                    <a href="issued_book_list.php" class="btn">
                        <div class="card-body">
                            <i class="fa fa-book-reader fa-2x mb-2"></i>
                            <h5>Issued Books</h5>
                            <h3 id="issuedBooks">0</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <a href="issued_book_list.php" class="btn">
                            <i class="fa fa-undo fa-2x mb-2"></i>
                            <h5>Returned Books</h5>
                            <h3 id="returnedBooks">0</h3>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <i class="fa fa-boxes fa-2x mb-2"></i>
                        <h5>Total Books Quantity</h5>
                        <h3 id="bookQuantity">0</h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <h4 class="text-center">Issued & Return</h4>

                    <canvas id="bookChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h4 class="text-center">Books & Students</h4>
                    <canvas id="compareChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const totalBooks = <?= $totalBooks ?>;
    const issuedBooks = <?= $issued ?>;
    const returnedBooks = <?= $returned ?>;
    const totalQuantity = <?= $totalQty ?>;
    const totalStudents = <?= $students ?>;


    document.getElementById('totalBooks').innerText = totalBooks;
    document.getElementById('issuedBooks').innerText = issuedBooks;
    document.getElementById('returnedBooks').innerText = returnedBooks;
    document.getElementById('bookQuantity').innerText = totalQuantity;

    new Chart(document.getElementById('bookChart'), {
        type: 'bar',
        data: {
            labels: ['Issued Books', 'Returned Books'],
            datasets: [{
                label: 'Books',
                data: [issuedBooks, returnedBooks],
                backgroundColor: ['#f39c12', '#27ae60']
            }]
        }
    });

    new Chart(document.getElementById('compareChart'), {
        type: 'bar',
        data: {
            labels: ['Total Books', 'Total Students'],
            datasets: [{
                label: 'Count',
                data: [totalBooks, totalStudents],
                backgroundColor: ['#3498db', '#9b59b6']
            }]
        }
    });
</script>


<?php include("common/footer.php");

?>