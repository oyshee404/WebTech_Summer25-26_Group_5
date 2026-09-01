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

if(!$user)
{
    Header("Location:../View/login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $specialty = trim($_POST["specialty"] ?? "");

    if(empty($name) || strlen($name) < 5)
    {
        $message = "Name must be at least 5 characters";
    }
    else if(empty($email))
    {
        $message = "Email is required";
    }
    else
    {
        $result = $database->updateProfile(
            $connection,
            "users",
            $username,
            $name,
            $email,
            $phone,
            $address,
            $specialty
        );

        if($result)
        {
            $message = "Profile Updated Successfully";
            $user = $database->getUser($connection, "users", $username);
        }
        else
        {
            $message = "Please try again";
        }
    }
}

?>
