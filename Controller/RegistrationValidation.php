<?php

include "../Model/db.php";

$name = "";
$email = "";
$gender = "";
$phone = "";
$dob = "";
$membership = "";
$address = "";
$username = "";
$password = "";
$confirmPassword = "";
$message = "";

$valid = true;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $gender = $_POST["gender"] ?? "";
    $phone = trim($_POST["phone"] ?? "");
    $dob = $_POST["dob"] ?? "";
    $membership = $_POST["membership"] ?? "";
    $address = trim($_POST["address"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $confirmPassword = trim($_POST["confirmPassword"] ?? "");
    $condition = isset($_POST["condition"]);

    if(empty($name))
    {
        $message = "Name is required";
        $valid = false;
    }

    if(empty($email))
    {
        $message = "Email is required";
        $valid = false;
    }

    if(empty($gender))
    {
        $message = "Please select gender";
        $valid = false;
    }

    if(empty($phone))
    {
        $message = "Phone is required";
        $valid = false;
    }

    if(empty($dob))
    {
        $message = "Date of Birth is required";
        $valid = false;
    }

    if(empty($membership))
    {
        $message = "Please select membership";
        $valid = false;
    }

    if(empty($address))
    {
        $message = "Address is required";
        $valid = false;
    }

    if(empty($username) || strlen($username) < 5)
    {
        $message = "Username must be at least 5 characters";
        $valid = false;
    }

    if(empty($password) || strlen($password) < 5)
    {
        $message = "Password must be at least 5 characters";
        $valid = false;
    }

    if($password != $confirmPassword)
    {
        $message = "Passwords do not match";
        $valid = false;
    }

    if(!$condition)
    {
        $message = "Please agree to the Terms and Conditions";
        $valid = false;
    }

    if($valid)
    {
        $database = new db();
        $connection = $database->connection();

        $check = $database->CheckUser($connection, "users", $username);

        if($check->num_rows > 0)
        {
            $message = "User Name Already Taken";
        }
        else
        {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $role = "Member";

            $result = $database->signup(
                $connection,
                "users",
                $name,
                $email,
                $gender,
                $phone,
                $dob,
                $membership,
                $address,
                $username,
                $password,
                $role
            );

            if($result)
            {
                Header("Location:../View/login.php");
                exit();
            }
            else
            {
                $message = "Registration failed. Please try again.";
            }
        }
    }
}

?>
