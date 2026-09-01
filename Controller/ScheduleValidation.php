<?php

include "../../Model/db.php";

session_start();

if(!isset($_SESSION["logged_in"]) || $_SESSION["role"] != "Trainer")
{
    Header("Location:../View/login.php");
    exit();
}

$message = "";

$database = new db();
$connection = $database->connection();

$members = $database->getAssignedMembers($connection, "users", "trainer_assignments", $_SESSION["user_id"]);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $member_id = trim($_POST["member_id"] ?? "");
    $schedule_date = trim($_POST["schedule_date"] ?? "");
    $time = trim($_POST["time"] ?? "");
    $activity = trim($_POST["activity"] ?? "");

    if(empty($member_id) || empty($schedule_date) || empty($time) || empty($activity))
    {
        $message = "All schedule fields are required";
    }
    else
    {
        $check = $connection->query("SELECT * FROM trainer_assignments WHERE member_id='".$member_id."' AND trainer_id='".$_SESSION["user_id"]."'");

        if(!$check || $check->num_rows == 0)
        {
            $message = "You can only assign schedules to your assigned members";
        }
        else
        {
            $result = $database->addSchedule(
                $connection,
                "schedules",
                $_SESSION["user_id"],
                $member_id,
                $schedule_date,
                $time,
                $activity
            );

            if($result)
            {
                $message = "Schedule Assigned to Member";
            }
            else
            {
                $message = "Please try again";
            }
        }
    }
}

if(isset($_GET["delete"]))
{
    $database->deleteSchedule(
        $connection,
        "schedules",
        $_GET["delete"]
    );

    Header("Location:schedule.php");
    exit();
}

$schedule = $database->getSchedule(
    $connection,
    "schedules",
    $_SESSION["user_id"]
);

?>
