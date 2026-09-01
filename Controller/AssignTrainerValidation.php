<?php

include "../../Model/db.php";

session_start();

if(!isset($_SESSION["logged_in"]) || $_SESSION["role"] != "Admin")
{
    Header("Location:../View/login.php");
    exit();
}

$message = "";

$database = new db();
$connection = $database->connection();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $member_id = trim($_POST["member_id"] ?? "");
    $trainer_id = trim($_POST["trainer_id"] ?? "");

    if(empty($member_id) || empty($trainer_id))
    {
        $message = "Please select a member and a trainer";
    }
    else
    {
        $result = $database->assignTrainer(
            $connection,
            "trainer_assignments",
            $member_id,
            $trainer_id
        );

        if($result)
        {
            $message = "Trainer Assigned Successfully";
        }
        else
        {
            $message = "Please try again";
        }
    }
}

$members = $database->getMembers($connection, "users");
$trainers = $database->getTrainers($connection, "users");

?>
