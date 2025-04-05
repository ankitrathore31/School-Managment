<?php
include("common/header.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($confirm_password == $password) {
        $query = "INSERT INTO user (name, email, number, address, password) 
                  VALUES('$name', '$email', '$number', '$address', '$password')";

        $result = mysqli_query($db, $query);

        if ($result) {
            echo "<script>alert('Register Successful'); window.location.assign('login.php');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($db) . "'); window.location.assign('register.php');</script>";
        }
    } else {
        echo "<script>alert('Error: Confirm Password & Password do not match'); window.history.back();</script>";
    }
}
?>




<style>
    .register-container {
        max-width: 500px;
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .register-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .register-header h4 {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border-radius: 5px;
    }

    .btn-success {
        width: 100%;
        font-size: 16px;
        padding: 10px;
        border-radius: 5px;
    }

    .form-group i {
        position: absolute;
        margin: 10px;
        color: #777;
    }

    .input-group {
        position: relative;
    }

    .input-group .form-control {
        padding-left: 40px;
    }
</style>
<div class="container">
    <div class="register-container">
        <div class="register-header">
            <h4><i class="fas fa-user-plus"></i> Register Here</h4>
            <p class="text-muted">Create your account in a few steps</p>
        </div>

        <form method="POST">
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name:</label>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email:</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="number" class="form-label">Number:</label>
                <div class="input-group">
                    <i class="fas fa-phone"></i>
                    <input type="number" name="number" class="form-control" placeholder="Enter Number" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="address" class="form-label">Address:</label>
                <div class="input-group">
                    <i class="fas fa-map-marker-alt"></i>
                    <textarea name="address" class="form-control" placeholder="Enter Address"></textarea>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password:</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="confirm_password" class="form-label">Confirm Password:</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                </div>
            </div>

            <div class="form-group mb-3 text-center">
                <button type="submit" name="submit" class="btn btn-success">Sign Up</button>
            </div>

            <p class="text-center text-muted">Already have an account? <a href="login.php" class="text-success">Login here</a></p>
        </form>
    </div>
</div>


<?php
include("common/footer.php");
?>