<?php

include "../../Model/db.php";

session_start();

if(!isset($_SESSION["logged_in"]))
{
    Header("Location:../View/login.php");
    exit();
}

$username = $_SESSION["username"];
$message = "";

$database = new db();
$connection = $database->connection();
$user = $database->getUser($connection, "users", $username);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $oldPassword = trim($_POST["oldPassword"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $confirmPassword = trim($_POST["confirmPassword"] ?? "");

    if(empty($oldPassword) || empty($password) || empty($confirmPassword))
    {
        $message = "All password fields are required";
    }
    else if(strlen($password) < 5)
    {
        $message = "Password must be at least 5 characters";
    }
    else if($password != $confirmPassword)
    {
        $message = "Passwords do not match";
    }
    else if($password == $oldPassword)
    {
        $message = "old password can not be new password";
    }
    else if(!password_verify($oldPassword, $user["password"]))
    {
        $message = "Current Password is incorrect";
    }
    else
    {
        $newPassword = password_hash($password, PASSWORD_DEFAULT);

        $result = $database->updatePassword(
            $connection,
            "users",
            $username,
            $newPassword
        );

        if($result)
        {
            $message = "Password Updated Successfully";
        }
        else
        {
            $message = "Please try again";
        }
    }
}

?>
