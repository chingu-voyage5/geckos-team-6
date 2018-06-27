<?php
    ob_start();
    session_start(); // Enables the use of sessions

    $timezone = date_default_timezone_set("America/Los_Angeles");

    $con = mysqli_connect("localhost", "techbboi", "", "geckofy");

    // Check connection and gives error message not error number
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


?>
