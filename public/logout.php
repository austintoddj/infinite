<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
// Simple logout
// $_SESSION["admin_id"] = null;
// $_SESSION["username"] = null;
// redirect_to("login.php");
?>

<?php
// More advanced logout
// Assumes there is NOTHING in the session to keep
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
redirect_to("login.php");
?>