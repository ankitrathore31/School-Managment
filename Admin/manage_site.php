<?php session_start();
include("common/header.php");

if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}

// Fetch existing school data
$sql = "SELECT * FROM school LIMIT 1"; // Change if you want to fetch by ID or title
$result = $db->query($sql);
$row = $result->fetch_assoc();

// Form submission
if (isset($_POST['submit'])) {
    $school_title = $_POST['school_title'] ?? '';
    $school_subtitle = $_POST['school_subtitle'] ?? '';
    $keyword = $_POST['keywords'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $email = $_POST['email'] ?? '';
    $description = $_POST['description'] ?? '';
    $address = $_POST['address'] ?? '';
    $post = $_POST['post'] ?? '';
    $district = $_POST['district'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    $state = $_POST['state'] ?? '';
    $country = $_POST['country'] ?? '';
    $instagram_link = $_POST['instagram_link'] ?? '';
    $linkedIn_link = $_POST['linkedIn_link'] ?? '';
    $facebook_link = $_POST['facebook_link'] ?? '';
    $telegram_link = $_POST['telegram_link'] ?? '';
    $youtube_link = $_POST['youtube_link'] ?? '';
    $twitter_link = $_POST['twitter_link'] ?? '';
    $website_link = $_POST['website_link'] ?? '';
    $established_year = $_POST['established_year'] ?? '';

    $target_dir = "assets/images/";
    $logo_path = $row['logo']; // Default to existing logo

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK) {
        $logo = basename($_FILES['logo']['name']);
        $logo_path = $target_dir . $logo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path);
    }

    $sql_update = "UPDATE school SET 
        school_title = '$school_title',
        school_subtitle = '$school_subtitle',
        keywords = '$keyword',
        phone_number = '$phone_number',
        email = '$email',
        description = '$description',
        address = '$address',
        post = '$post',
        district = '$district',
        pincode = '$pincode',
        state = '$state',
        country = '$country',
        instagram_link = '$instagram_link',
        linkedIn_link = '$linkedIn_link',
        facebook_link = '$facebook_link',
        telegram_link = '$telegram_link',
        youtube_link = '$youtube_link',
        twitter_link = '$twitter_link',
        website_link = '$website_link',
        established_year = '$established_year',
        logo = '$logo_path'";

    $sql_update .= " WHERE id = " . $row['id']; // Make sure ID exists

    if ($db->query($sql_update) === TRUE) {
        echo "<script>alert('Site Updated'); window.location.href='';</script>";
    } else {
        echo "Error: " . $db->error;
    }
}
?>
<style>
    .form-group {
        position: relative;
        margin: 20px 0;
        font-family: Arial, sans-serif;
    }

    .form-group label {
        position: absolute;
        bottom: 45%;
        /* top: 50%; */
        left: 10px;
        transform: translateY(-50%);
        background-color: white;
        padding: 0 5px;
        color: #555;
        font-size: 14px;
        transition: all 0.2s ease-in-out;
        pointer-events: none;
    }

    .form-group textarea {
        height: 50px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 9px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        font-size: 14px;
        outline: none;
    }

    .form-group input:focus .form-group textarea:focus {
        border-color: #007bff;
    }

    /* .form-group input:focus+label,
    .form-group textarea:focus+label,
    .form-group input:not(:placeholder-shown)+label .form-group textarea:not(:placeholder-shown)+label {
        top: -10px;
        font-size: 12px;
        color: #007bff;
    } */
</style>
<div class="wrapper">
    <div class="main-content">
        <div class="card mt-5">
            <div class="card-header">
                <div class="crad-title text-center">
                    <h3>Manage Site</h3>
                </div>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" id="schoolTitle" name="school_title" value="<?= $row['school_title'] ?>" placeholder=" " required>
                            <label for="schoolTitle">School Title</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" name="school_subtitle" class="form-control" value="<?= $row['school_subtitle'] ?>" placeholder=" ">
                            <label for="title">School Sub Title</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" name="phone_number" class="form-control" value="<?= $row['phone_number'] ?>" placeholder=" ">
                            <label for="number">School Number</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3 form-group">
                            <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>" placeholder=" ">
                            <label for="email">School Email</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" name="keywords" class="form-control" value="<?= $row['keywords'] ?>" placeholder=" ">
                            <label for="number">School Keywords</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" name="established_year" class="form-control" value="<?= $row['established_year'] ?>" placeholder=" ">
                            <label for="established_year">School Established Year</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            <textarea name="description" class="form-control" placeholder=" "><?= $row['description'] ?></textarea>
                            <label for="description">School Description</label>
                        </div>
                        <div class="col-md-6 mb-3 form-group">
                            <textarea name="address" class="form-control" placeholder=" "><?= $row['address'] ?></textarea>
                            <label for="address">School Address</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" name="post" class="form-control" value="<?= $row['post'] ?>" placeholder="">
                            <label for="town">School Post/Town</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" name="district" class="form-control" value="<?= $row['district'] ?>" placeholder="">
                            <label for="district">School District</label>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" name="pincode" class="form-control" value="<?= $row['pincode'] ?>" placeholder="">
                            <label for="pincode">School Pincode</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3 form-group">
                            <select class="form-control" id="state" name="state">
                                <option value="" disabled>Select State</option>
                                <?php
                                $states = [
                                    "Andhra Pradesh",
                                    "Arunachal Pradesh",
                                    "Assam",
                                    "Bihar",
                                    "Chhattisgarh",
                                    "Goa",
                                    "Gujarat",
                                    "Haryana",
                                    "Himachal Pradesh",
                                    "Jharkhand",
                                    "Karnataka",
                                    "Kerala",
                                    "Madhya Pradesh",
                                    "Maharashtra",
                                    "Manipur",
                                    "Meghalaya",
                                    "Mizoram",
                                    "Nagaland",
                                    "Odisha",
                                    "Punjab",
                                    "Rajasthan",
                                    "Sikkim",
                                    "Tamil Nadu",
                                    "Telangana",
                                    "Tripura",
                                    "Uttar Pradesh",
                                    "Uttarakhand",
                                    "West Bengal",
                                    "Andaman and Nicobar Islands",
                                    "Chandigarh",
                                    "Dadra and Nagar Haveli and Daman and Diu",
                                    "Lakshadweep",
                                    "Delhi",
                                    "Puducherry",
                                    "Ladakh",
                                    "Jammu and Kashmir"
                                ];
                                foreach ($states as $state) {
                                    $selected = ($row['state'] == $state) ? 'selected' : '';
                                    echo "<option value=\"$state\" $selected>$state</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            <input type="text" id="country" name="country" value="<?= $row['country'] ?>" placeholder=" " required>
                            <label for="country">Country</label>
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            <input type="url" id="instagramLink" name="instagram_link" value="<?= $row['instagram_link'] ?>" placeholder=" " required>
                            <label for="instagramLink">Instagram Link</label>
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            <input type="url" id="linkedinLink" name="linkedIn_link" value="<?= $row['linkedIn_link'] ?>" placeholder=" " required>
                            <label for="linkedinLink">LinkedIn Link</label>
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            <input type="url" id="facebookLink" name="facebook_link" value="<?= $row['facebook_link'] ?>" placeholder=" " required>
                            <label for="facebookLink">Facebook Link</label>
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            <input type="url" id="telegramLink" name="telegram_link" value="<?= $row['telegram_link'] ?>" placeholder=" " required>
                            <label for="telegramLink">Telegram Link</label>
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            <input type="url" id="youtubeLink" name="youtube_link" value="<?= $row['youtube_link'] ?>" placeholder=" " required>
                            <label for="youtubeLink">YouTube Link</label>
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            <input type="url" id="twitterLink" name="twitter_link" value="<?= $row['twitter_link'] ?>" placeholder=" " required>
                            <label for="twitterLink">Twitter Link</label>
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            <input type="url" id="websiteLink" name="website_link" value="<?= $row['website_link'] ?>" placeholder=" " required>
                            <label for="websiteLink">Website Link</label>
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            <label>Current Logo:</label><br>
                            <img src="<?= $row['logo'] ?>" alt="Logo" width="100"><br><br>
                            <input type="file" id="websitelogo" name="logo" placeholder=" ">
                            <label class="" for="websitelogo">Website Logo</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3 mt-2">
                            <input type="submit" name="submit" class="btn btn-success w-100 rounded" value="Update School Info">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>





<?php include("common/footer.php");
?>