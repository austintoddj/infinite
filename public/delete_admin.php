<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$admin = find_admin_by_id($_GET["id"]);
if (!$admin) {
    // Admin ID was missing or invalid or
    // admin couldn't be found in the database
    redirect_to("manage_admins.php");
}

$id     = $admin["id"];
$query  = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "User has been deleted.";
    redirect_to("manage_admins.php");
} else {
    // Failure
    $_SESSION["message"] = "User has not been deleted.";
    redirect_to("manage_admins.php");
}

?>