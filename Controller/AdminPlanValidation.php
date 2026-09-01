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
    $name = trim($_POST["name"] ?? "");
    $duration = trim($_POST["duration"] ?? "");
    $facilities = trim($_POST["facilities"] ?? "");
    $price = trim($_POST["price"] ?? "");

    if(empty($name) || empty($duration) || empty($facilities) || empty($price))
    {
        $message = "All plan fields are required";
    }
    else
    {
        $result = $database->addPlan(
            $connection,
            "membership_plans",
            $name,
            $duration,
            $facilities,
            $price
        );

        if($result)
        {
            $message = "Membership Plan Added";
        }
        else
        {
            $message = "Please try again";
        }
    }
}

if(isset($_GET["delete"]))
{
    $id = $_GET["delete"];

    $database->deletePlan(
        $connection,
        "membership_plans",
        $id
    );

    Header("Location:membership_plans.php");
    exit();
}

$plans = $database->getPlans($connection, "membership_plans");

?>
