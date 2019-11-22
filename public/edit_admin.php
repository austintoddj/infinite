<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$admin = find_admin_by_id($_GET["id"]);

if (!$admin) {
    // Admin ID was missing or invalid or
    // admin couldn't be found in the database
    redirect_to("manage_admins.php");
}
?>

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

        $id              = $admin["id"];
        $username        = mysql_prep($_POST["username"]);
        $hashed_password = password_encrypt($_POST["password"]);
        $first_name      = mysql_prep($_POST["first_name"]);
        $last_name       = mysql_prep($_POST["last_name"]);
        $email           = mysql_prep($_POST["email"]);
        $gender          = mysql_prep($_POST["gender"]);
        $age             = $_POST["age"];
        $bio             = mysql_prep($_POST["bio"]);

        $query = "UPDATE admins SET ";
        $query .= "username = '{$username}', ";
        $query .= "first_name = '{$first_name}', ";
        $query .= "last_name = '{$last_name}', ";
        $query .= "email = '{$email}', ";
        $query .= "gender = '{$gender}', ";
        $query .= "age = {$age}, ";
        $query .= "bio = '{$bio}', ";
        $query .= "hashed_password = '{$hashed_password}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Success
            $_SESSION["message"] = "User has been updated successfully.";
            redirect_to("manage_admins.php");
        } else {
            // Failure
            $_SESSION["message"] = "User has not been updated successfully.";
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

            <h1 class="page-header"><?php echo $admin["first_name"] . " " . $admin["last_name"]; ?></h1>
            <span style="font-size: 10px;"><a href="admin.php">Dashboard</a> > <a
                    href="manage_admins.php">People</a> > <?php echo $admin["first_name"] . " " . $admin["last_name"]; ?></span>
            <br/>
            <br/>

            <div class="row">
                <img src="/img/default-user.png" height="100" width="100" alt="" class="img-responsive"
                     id="default-user" style="float: left; display: inline-block;">

                <p style="margin-left: 10em;"><span
                        style="font-weight: 300; font-size: 21px; line-height: 29px; font-family: Helvetica Neue; color: rgb(51, 51, 51);"><?php echo htmlentities($admin["username"]); ?></span><br/><br/><?php echo htmlentities($admin["bio"]); ?>
                </p>
            </div>
            <br/>

            <ul class="nav nav-tabs">
                <li role="presentation"><a href="profile.php?id=<?php echo urlencode($admin["id"]); ?>">View</a></li>
                <li role="presentation" class="active"><a href="">Edit</a></li>
            </ul>

            <br/>
            <br/>

            <?php echo message(); ?>
            <?php echo form_errors($errors); ?>
            <!-- Begin form -->
            <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post" role="form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label> <span class="red-star">*</span>
                            <input name="first_name" type="text" class="form-control" id="first_name"
                                   value="<?php echo htmlentities($admin["first_name"]); ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label> <span class="red-star">*</span>
                            <input name="last_name" type="text" class="form-control" id="last_name"
                                   value="<?php echo htmlentities($admin["last_name"]); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">Username</label> <span class="red-star">*</span>
                            <input name="username" type="text" class="form-control" id="username"
                                   value="<?php echo htmlentities($admin["username"]); ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input name="age" type="text" class="form-control" id="age"
                                       value="<?php echo htmlentities($admin["age"]); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label> <span class="red-star">*</span>
                            <input name="email" type="text" class="form-control" id="email"
                                   value="<?php echo htmlentities($admin["email"]); ?>"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="subject_name">Gender</label>
                            <br/>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="inlineRadio2"
                                       value="M" <?php if ($admin["gender"] === "M") {
                                    echo "checked";
                                } ?> > Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="inlineRadio1"
                                       value="F" <?php if ($admin["gender"] === "F") {
                                    echo "checked";
                                } ?> > Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password">Password</label> <span class="red-star">*</span>
                            <input type="password" name="password" class="form-control" id="password"
                                   value="<?php echo htmlentities($admin["hashed_password"]); ?>"/>

                            <p class="text-muted"><i>For added security, use upper and lower case letters, numbers, and
                                    symbols like ! " ? $ % ^ & ).</i></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bio">Bio</label> <span class="red-star">*</span>
                            <textarea class="form-control" rows="5" name="bio"
                                      id="bio"><?php echo htmlentities($admin["bio"]); ?></textarea>

                            <p class="text-muted"><i>Share a little biographical information to fill out your profile.
                                    This may be shown publicly. 200 character limit.</i></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Save" class="btn btn-success"/>&nbsp;&nbsp;<a
                        class="btn btn-danger" href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>"
                        onclick="return confirm('Are you sure you want to delete <?php echo $admin["first_name"] . " " . $admin["last_name"]; ?>?');">Delete</a>&nbsp;&nbsp;<a
                        href="manage_admins.php">Cancel</a>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
</div>
<!-- End Page Content -->

<?php include("../includes/layouts/footer.php"); ?>
</body>
</html>