<?php

include "../Model/db.php";

session_start();

if(!isset($_SESSION["logged_in"]))
{
    Header("Location:../View/login.php");
    exit();
}

$username = $_SESSION["username"];

$database = new db();
$connection = $database->connection();

$result = $database->deleteUser($connection, "users", $username);

session_unset();
session_destroy();

Header("Location:../View/login.php");
exit();

?>
