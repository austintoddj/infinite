<?php

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit();
}

function mysql_prep($string) {
    global $connection;

    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
}

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed.");
    }
}

function form_errors($errors = array()) {
    $output = "";

    // ** This loop was broken, still not sure why..
    // UPDATE: IT'S THAT STUPID DASH INSTEAD OF AN EQUALS SIGN!!
    // if (!empty($errors)) {
    //     $output .= "<div class=\"alert alert-danger\">";
    //     $output .= "<ul>";
    //     foreach ($errors as $key => $error) {
    //         $output .= "<li>";
    //         $output .- htmlentities($error);
    //         $output .= "</li>";
    //     }
    //     $output .= "</ul>";
    //     $output .= "</div>";
    // }

    if (!empty($errors)) {
        $output .= "<div class=\"alert alert-danger\">";
        $output .= "<ul>";
        foreach ($errors as $key => $error) {
            $output .= "<li>";
            $output .= htmlentities($error);
            $output .= "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

function find_all_subjects($public = true) {
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM subjects ";
    if ($public) {
        $query .= "WHERE visible = 1 ";
    }
    $query .= "ORDER BY position ASC";
    $subject_set = mysqli_query($connection, $query);
    confirm_query($subject_set);
    return $subject_set;
}

function find_pages_for_subject($subject_id, $public = true) {
    global $connection;

    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);

    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE subject_id = {$safe_subject_id} ";
    if ($public) {
        $query .= "AND visible = 1 ";
    }
    $query .= "ORDER BY position ASC";
    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set);
    return $page_set;
}

function find_subject_by_id($subject_id, $public = true) {
    global $connection;

    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);

    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id = {$safe_subject_id} ";
    if ($public) {
        $query .= "AND visible = 1 ";
    }
    $query .= "LIMIT 1";
    $subject_set = mysqli_query($connection, $query);
    confirm_query($subject_set);
    if ($subject = mysqli_fetch_assoc($subject_set)) {
        return $subject;
    } else {
        return null;
    }
}

function find_page_by_id($page_id, $public = true) {
    global $connection;

    $safe_page_id = mysqli_real_escape_string($connection, $page_id);

    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id = {$safe_page_id} ";
    if ($public) {
        $query .= "AND visible = 1 ";
    }
    $query .= "LIMIT 1";
    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set);
    if ($page = mysqli_fetch_assoc($page_set)) {
        return $page;
    } else {
        return null;
    }
}

function find_default_page_for_subject($subject_id) {
    $page_set = find_pages_for_subject($subject_id);
    if ($first_page = mysqli_fetch_assoc($page_set)) {
        return $first_page;
    } else {
        return null;
    }
}

function find_selected_page($public = false) {
    global $current_subject;
    global $current_page;

    if (isset($_GET["subject"])) {
        $current_subject = find_subject_by_id($_GET["subject"], $public);
        if ($current_subject && $public) {
            $current_page = find_default_page_for_subject($current_subject["id"]);
        } else {
            $current_page = null;
        }
    } elseif (isset($_GET["page"])) {
        $current_subject = null;
        $current_page    = find_page_by_id($_GET["page"], $public);
    } else {
        $current_subject = null;
        $current_page    = null;
    }
}

function content_list($subject_array, $page_array) {
    // content_list takes 2 arguments
    // - the current subject array or null
    // - the current page array or null
    $output      = "<ul>";
    $subject_set = find_all_subjects(false);
    while ($subject = mysqli_fetch_assoc($subject_set)) {
        $output .= "<li";
        if ($subject_array && $subject["id"] == $subject_array["id"]) {
            $output .= " class=\"active\"";
        }
        $output .= ">";
        $output .= "<a href=\"manage_content.php?subject=";
        $output .= urlencode($subject["id"]);
        $output .= "\">";
        $output .= htmlentities($subject["menu_name"]);
        $output .= "</a>";

        $page_set = find_pages_for_subject($subject["id"], false);
        $output .= "<ul>";
        while ($page = mysqli_fetch_assoc($page_set)) {
            $output .= "<li";
            if ($page_array && $page["id"] == $page_array["id"]) {
                $output .= " class=\"active\"";
            }
            $output .= ">";
            $output .= "<a href=\"manage_content.php?page=";
            $output .= urlencode($page["id"]);
            $output .= "\">";
            $output .= "<i>" . htmlentities($page["menu_name"]) . "</i>";
            $output .= "</a></li>";
        }
        mysqli_free_result($page_set);
        $output .= "</ul></li>";
    }
    mysqli_free_result($subject_set);
    $output .= "</ul>";
    return $output;
}

function navigation($subject_array, $page_array) {
    // navigation takes 2 arguments
    // - the current subject array or null
    // - the current page array or null
    $output      = "<ul class=\"nav nav-sidebar\">";
    $subject_set = find_all_subjects(false);
    while ($subject = mysqli_fetch_assoc($subject_set)) {
        $output .= "<li";
        if ($subject_array && $subject["id"] == $subject_array["id"]) {
            $output .= " class=\"active\"";
        }
        $output .= ">";
        $output .= "<a href=\"manage_content.php?subject=";
        $output .= urlencode($subject["id"]);
        $output .= "\">";
        $output .= htmlentities($subject["menu_name"]);
        $output .= "</a>";

        $page_set = find_pages_for_subject($subject["id"], false);
        $output .= "<ul class=\"nav-child nav-sidebar-child\">";
        while ($page = mysqli_fetch_assoc($page_set)) {
            $output .= "<li";
            if ($page_array && $page["id"] == $page_array["id"]) {
                $output .= " class=\"active\"";
            }
            $output .= ">";
            $output .= "<a href=\"manage_content.php?page=";
            $output .= urlencode($page["id"]);
            $output .= "\">";
            $output .= "<i>" . htmlentities($page["menu_name"]) . "</i>";
            $output .= "</a></li>";
        }
        mysqli_free_result($page_set);
        $output .= "</ul></li>";
    }
    mysqli_free_result($subject_set);
    $output .= "</ul>";
    return $output;
}

function public_navigation($subject_array, $page_array) {
    // public_navigation takes 2 arguments
    // - the current subject array or null
    // - the current page array or null
    $output      = "<ul class=\"nav nav-sidebar\">";
    $subject_set = find_all_subjects(false);
    while ($subject = mysqli_fetch_assoc($subject_set)) {
        $output .= "<li";
        if ($subject_array && $subject["id"] == $subject_array["id"]) {
            $output .= " class=\"active\"";
        }
        $output .= ">";
        $output .= "<a href=\"index.php?subject=";
        $output .= urlencode($subject["id"]);
        $output .= "\">";
        $output .= htmlentities($subject["menu_name"]);
        $output .= "</a>";

        $page_set = find_pages_for_subject($subject["id"], false);
        $output .= "<ul class=\"nav-child nav-sidebar-child\">";
        while ($page = mysqli_fetch_assoc($page_set)) {
            $output .= "<li";
            if ($page_array && $page["id"] == $page_array["id"]) {
                $output .= " class=\"active\"";
            }
            $output .= ">";
            $output .= "<a href=\"index.php?page=";
            $output .= urlencode($page["id"]);
            $output .= "\">";
            $output .= "<i>" . htmlentities($page["menu_name"]) . "</i>";
            $output .= "</a></li>";
        }
        mysqli_free_result($page_set);
        $output .= "</ul></li>";
    }
    mysqli_free_result($subject_set);
    $output .= "</ul>";
    return $output;
}

function all_subjects() {
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "ORDER BY id ASC";
    $all_subjects = mysqli_query($connection, $query);
    confirm_query($all_subjects);
    return $all_subjects;
}

function all_pages() {
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "ORDER BY id ASC";
    $all_pages = mysqli_query($connection, $query);
    confirm_query($all_pages);
    return $all_pages;
}

function find_all_admins() {
    global $connection;

    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "ORDER BY id ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
}

function find_admin_by_id($admin_id) {
    global $connection;

    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);

    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE id = {$safe_admin_id} ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function find_admin_by_username($username) {
    global $connection;

    $safe_username = mysqli_real_escape_string($connection, $username);

    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE username = '{$safe_username}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if ($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
        return null;
    }
}

function pluralize($num, $plural = 's', $single = '') {
    if ($num == 1) return $single; else return $plural;
}

function password_encrypt($password) {
    $hash_format     = "$2y$10$"; // Tells PHP to use Blowfish with a "cost" of 10
    $salt_length     = 22;
    $salt            = generate_salt($salt_length);
    $format_and_salt = $hash_format . $salt;
    $hash            = crypt($password, $format_and_salt);
    return $hash;
}

function generate_salt($length) {
    // Not 100% unique, not 100% random, but good enough for a salt
    // MD5 returns 32 characters
    $unique_random_string = md5(uniqid(mt_rand(), true));

    // Valid characters for a salt are [a-zA-Z0-9./]
    $base64_string = base64_encode($unique_random_string);

    // But not '+' which is valid in base64 encoding
    $modified_base64_string = str_replace('+', '.', $base64_string);

    // Truncate string to the correct length
    $salt = substr($modified_base64_string, 0, $length);

    return $salt;
}

function password_check($password, $existing_hash) {
    // Existing hash contains format and salt at start
    $hash = crypt($password, $existing_hash);

    if ($hash === $existing_hash) {
        return true;
    } else {
        return false;
    }
}

function attempt_login($username, $password) {
    $admin = find_admin_by_username($username);

    if ($admin) {
        // If admin is found, check the password
        if (password_check($password, $admin["hashed_password"])) {

            // Password matches
            return $admin;
        } else {
            // Password does not match
            return false;
        }
    } else {
        // Admin is not found
        return false;
    }
}

function logged_in() {
    return isset($_SESSION['admin_id']);
}

function confirm_logged_in() {
    if (!logged_in()) {
        redirect_to("login.php");
    }
}


/**
 * Debug dump and die
 */
function dd() {
    echo "<pre>";
    foreach (func_get_args() as $arg) {
        var_dump($arg);
    }
    echo "</pre>";
}

?>