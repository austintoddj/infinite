<?php
define("DB_SERVER", "localhost");
define("DB_USER", "infinite_admin");
define("DB_PASS", "admin");
define("DB_NAME", "infinite");

// 1. Create a database connection
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Test if the connection succeeded
if (mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_errno() .
        " (" . mysqli_connect_errno() . ")"
    );
}
?>