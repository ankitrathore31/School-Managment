
<?php
include("common/header.php");


?>

<!-- slider start -->
<div class="container-fluid">
    <img src="assets/images/children.jpg" class="slider-img" alt="">
</div>

<!--info section start-->
<section id="about">
    <div class="container-fluid">
        <div class="row m-4">
            <div class="col-md-5">
                <img src="assets/images/buliding.jpg" class="rounded" width="450" alt="">
            </div>
            <div class="col-md-7 school-title">
                <h3><b>Welcome To <span><?= $school['school_title']; ?></span></b></h3>
                <p><?= $school['description']; ?>
                </p>
                <p>
                    <marquee behavior="alternate" direction=""><?= $school['keywords']; ?></marquee>
                </p>
                <div class="row d-flex justify-content-between">
                    <div class="col">
                        <a href="about.html" class="btn btn-info"><i class="fas fa-info-circle"></i> More Info</a>
                    </div>
                    <div class="col">
                        <a href="tel:1122334455" class="btn btn-primary"><i class="fas fa-phone-alt"></i>+91
                            1122334455</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Faciliteis section start -->
<section>
    <div class="container mt-5">
        <div class="row justify-content-center d-flex">
            <div class="col text-center">
                <h2 class="section-title mb-4 typed-text"><b>FACILITEIS</b></h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded facilities">
                    <div class="card-body text-center">
                        <img src="assets/images/classroom.png" class="img-fluid mb-3" alt="Clean Classroom" width="200">
                        <h5 class="card-title font-weight-bold text-primary">Clean Classroom</h5>
                        <p class="card-text text-muted">
                            Our classrooms are always maintained to the highest standard,
                            as well as a clean and comfortable environment for learning.
                        </p>
                        <a href="#" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body text-center">
                        <img src="assets/images/facilities.jpg" alt="lunch area" class="img-fluid mb-3" width="200">
                        <h5 class="card-title font-weight-bold text-primary">Lunch Area</h5>
                        <p class="card-text text-muted">
                            Our Lunch Area are always maintained to the highest standard,
                            as well as a clean and comfortable environment for lunch area.
                        </p>
                        <a href="" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg bg-white rounded p-3 mb-5">
                    <div class="card-body text-center ">
                        <img src="assets/images/buliding.jpg" alt="" class="img-fluid mb-3" width="200">
                        <h5 class="card-title font-weight-bold text-primary">Ground Area</h5>
                        <p class="card-text text-muted">
                            Our Ground are always maintained to the highest standard,
                            as well as a clean and comfortable environment for playing.
                        </p>
                        <a href="" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section Start  -->
<section id="gallery">
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col text-center">
                <h2 class="section-title mb-3 typed-text"><b>Gallery</b></h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 text-center">
                <img src="assets/images/children1.jpg" alt="" class="img-fluid rounded p-3 shadow-lg" width="400">
            </div>
            <div class="col-md-4 text-center">
                <img src="assets/images/children1.jpg" alt="" class="img-fluid rounded p-3 shadow-lg" width="400">
            </div>
            <div class="col-md-4 text-center">
                <img src="assets/images/children1.jpg" alt="" class="img-fluid rounded p-3 shadow-lg" width="400">
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-md-4 text-center">
                <img src="assets/images/children1.jpg" alt="" class="img-fluid rounded p-3 shadow-lg" width="400">
            </div>
            <div class="col-md-4 text-center">
                <img src="assets/images/children1.jpg" alt="" class="img-fluid rounded p-3 shadow-lg" width="400">
            </div>
            <div class="col-md-4 text-center">
                <img src="assets/images/children1.jpg" alt="" class="img-fluid rounded p-3 shadow-lg" width="400">
            </div>
        </div>
    </div>
</section>
<!-- contact us section start  -->
<section id="contact">
    <div class="container mt-5 d-flex justify-content-center">
        <h2 class="text-center typed-text">Contact Us</h2>
    </div>
    <div class="card m-3">
        <div class="card-body text-center">
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114892.99359359173!2d79.
                4216191023692!3d28.3761304155136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39a0073
                34d02998d%3A0x5b9d44cf31ee87f!2sBareilly%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v17396980411
                33!5m2!1sen!2sin" width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
            </div>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-body m-3">
            <form action="">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="msg">Message:</label>
                        <textarea name="message" id="msg" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="submit" value="Send Message" class="btn btn-success rounded">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
include("common/footer.php");
?>