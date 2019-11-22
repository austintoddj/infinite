<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
$username = "";

if (isset($_POST['submit'])) {
    // Process the form

    // validations
    $required_fields = array("username", "password");
    validate_presences($required_fields);

    if (empty($errors)) {
        // Attempt Login

        $username = $_POST["username"];
        $password = $_POST["password"];

        $found_admin = attempt_login($username, $password);

        if ($found_admin) {
            // Success
            // Mark user as logged in
            $_SESSION["admin_id"] = $found_admin["id"];
            $_SESSION["username"] = $found_admin["username"];
            redirect_to("admin.php");
        } else {
            // Failure
            $_SESSION["login_errors"] = "Username and password combination was incorrect.";
        }
    }
} else {
    // This is probably a GET request

} // end: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_login.php"); ?>

<div class="login-container">
    <br/>

    <h1>
        <center><img src="img/infinite_logo.png" height="100px" ;></center>
    </h1>
    <br/>

    <form action="login.php" method="POST" class="login-form-signin" role="form">
        <?php echo message(); ?>
        <?php echo form_errors($errors); ?>
        <?php echo login_errors(); ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username"
                   value="<?php echo htmlentities($username); ?>" autofocus>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="">
        </div>
        <input type="submit" class="btn btn-larg btn-primary" name="submit" value="Log In">
    </form>
</div>
<br/>
<center><a href="http://infinite.dev/index.php" title="Are you lost?">← Back to Infinite</a></center>

<?php include("../includes/layouts/footer.php"); ?>
