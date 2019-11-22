<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$current_subject = find_subject_by_id($_GET["subject"], false);
if (!$current_subject) {
    // Subject ID was missing or invalid or
    // subject couln't be found in the database
    redirect_to("manage_content.php");
}

$pages_set = find_pages_for_subject($current_subject["id"], false);
if (mysqli_num_rows($pages_set) > 0) {
    $_SESSION["errors"] = ["This item cannot be deleted because it is still referenced by other pages."];
    redirect_to("manage_content.php");
}

$id     = $current_subject["id"];
$query  = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);
if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Subject has been deleted successfully.";
    redirect_to("manage_content.php");
} else {
    // Failure
    $_SESSION["message"] = "Subject has not been deleted successfully.";
    redirect_to("manage_content.php?subject={$id}");
}

?>