<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
if (isset($_POST['submit'])) {
    // Process the form

    // Validations
    $required_fields = array("first_name", "last_name", "username", "password", "email", "bio");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {
        // Perform Create

        $username        = mysql_prep($_POST["username"]);
        $hashed_password = password_encrypt($_POST["password"]);
        $first_name      = mysql_prep($_POST["first_name"]);
        $last_name       = mysql_prep($_POST["last_name"]);
        $email           = mysql_prep($_POST["email"]);
        $gender          = mysql_prep($_POST["gender"]);
        $age             = $_POST["age"];
        $bio             = mysql_prep($_POST["bio"]);

        $query = "INSERT INTO admins (";
        $query .= " username, first_name, last_name, email, gender, age, bio, hashed_password";
        $query .= ") VALUES (";
        $query .= " '{$username}', '{$first_name}', '{$last_name}', '{$email}', '{$gender}', {$age}, '{$bio}', '{$hashed_password}'";
        $query .= ")";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Success
            $_SESSION["message"] = "New user has been created successfully.";
            redirect_to("manage_admins.php");
        } else {
            // Failure
            $_SESSION["message"] = "New user has not been created successfully.";
        }
    }
} else {
    // This is probably a GET request
}   // End: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_admin.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Begin Sidebar -->
        <div class="col-sm-3 col-md-2 sidebar">

        </div>
        <!-- End Sidebar -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <h1 class="page-header">Create new user</h1>
            <?php echo message(); ?>
            <?php echo form_errors($errors); ?>
            <!-- Begin form -->
            <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > <a href="manage_admins.php">People</a> > Create new user</span>
            <br/>
            <br/>

            <form action="new_admin.php" method="post" role="form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label> <span class="red-star">*</span>
                            <input name="first_name" type="text" class="form-control" id="first_name" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label> <span class="red-star">*</span>
                            <input name="last_name" type="text" class="form-control" id="last_name" value=""/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">Username</label> <span class="red-star">*</span>
                            <input name="username" type="text" class="form-control" id="username" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input name="age" type="text" class="form-control" id="age" value=""/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label> <span class="red-star">*</span>
                            <input name="email" type="text" class="form-control" id="email" value=""/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="subject_name">Gender</label>
                            <br/>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="inlineRadio2" value="M"> Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="inlineRadio1" value="F"> Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password">Password</label> <span class="red-star">*</span>
                            <input name="password" type="password" class="form-control" id="password" value=""/>

                            <p class="text-muted"><i>For added security, use upper and lower case letters, numbers, and
                                    symbols like ! " ? $ % ^ & ).</i></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bio">Bio</label> <span class="red-star">*</span>
                            <textarea class="form-control" rows="5" name="bio" id="bio"></textarea>

                            <p class="text-muted"><i>Share a little biographical information to fill out your profile.
                                    This may be shown publicly. 200 character limit.</i></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Create" class="btn btn-success"/>&nbsp;&nbsp;<a
                        href="manage_admins.php">Cancel</a>
                </div>
            </form>
        </div>
        <!-- End Form -->
    </div>
</div>
</div>
<!-- End Page Content -->

<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>
