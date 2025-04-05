<?php
session_start();
include("common/header.php");

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Fetch user details
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user_data = mysqli_fetch_assoc($result); // Fetch user data

        // Store user details in session
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['user_name'] = $user_data['name'];
        $_SESSION['user_role'] = $user_data['role'];
        // $_SESSION['last_login_timestamp'] = time();

        if ($user_data['role'] === 'manager') {
            echo "<script>window.location.href='../manager/dashboard.php';</script>"; // Redirect manager
            exit;
        }if($user_data['role'] === 'admin') {
            echo "<script>window.location.href='../Admin/dashboard.php';</script>"; // Redirect admin
            exit;
        }if($user_data['role'] === 'teacher') {

            
                echo "<script>window.location.href='../Teacher/dashboard.php';</script>"; // Redirect admin
                exit;
        }else {
            echo "<script>window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Invalid Email or Password'); window.history.back();</script>";
    }
}


?>
<!-- login section start -->
<div class="container-fluid justify-content-center d-flex mt-5">
    <div class="row justify-content-center d-flex m-5 rounded">

        <div class="col-12 col-md-7 mb-3 mb-md-0">
            <img src="assets/images/buliding.jpg" class="rounded" width="500" alt="">
        </div>

        <div class="col-12 col-md-5 school-title login-container">
            <h3><b>Login To <span>Avid Vista School</span></b></h3>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="text-center">
                    <a href="stu-login.php" class="btn btn-success m-2">Student Login</a>
                    <input type="submit" name="login" value="Administer Login" class="btn btn-primary m-2">
                </div>
                <div class="mt-3">
                    <a href="register.php" class="btn text-primary btn-sm">Sign Up</a>
                    <a href="" class="btn text-danger btn-sm">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include("common/footer.php");
?>