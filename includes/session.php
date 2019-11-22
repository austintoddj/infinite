<?php

session_start();

function message()
{
    if (isset($_SESSION["message"])) {
        $output = "<div class=\"alert alert-success\">";
        $output .= "<span class=\"glyphicon glyphicon-ok-circle\"></span> ";
        $output .= htmlentities($_SESSION["message"]);
        $output .= "</div>";

        // Clear message after use
        $_SESSION["message"] = null;

        return $output;
    }
}

function errors()
{
    if (isset($_SESSION["errors"]) && is_array($_SESSION["errors"])) {

        $errors = $_SESSION["errors"];

        // Clear message after use
        $_SESSION["errors"] = null;


        return $errors;
    }
}

function login_errors()
{
    if (isset($_SESSION["login_errors"])) {
        $output = "<div class=\"alert alert-danger\">";
        $output .= "<span class=\"glyphicon glyphicon-exclamation-sign\"></span> ";
        $output .= htmlentities($_SESSION["login_errors"]);
        $output .= "</div>";

        // Clear error after use
        $_SESSION["login_errors"] = null;

        return $output;
    }
}

?>