<?php

include "../Model/db.php";

session_start();

if(!isset($_SESSION["logged_in"]) || $_SESSION["role"] != "Member")
{
    Header("Location:../View/login.php");
    exit();
}

$database = new db();
$connection = $database->connection();

if(isset($_GET["id"]))
{
    $schedule_id = $_GET["id"];
    $member_id = $_SESSION["user_id"];

    $check = $connection->query("SELECT * FROM schedules WHERE id='".$schedule_id."' AND member_id='".$member_id."'");

    if($check && $check->num_rows > 0)
    {
        $schedule = $check->fetch_assoc();

        if($schedule["status"] != "Completed")
        {
            $scheduledDateTime = strtotime($schedule["schedule_date"] . " " . $schedule["time"]);
            $currentDateTime = time();

            if($scheduledDateTime === false || $scheduledDateTime <= $currentDateTime)
            {
                $result = $database->completeSchedule($connection, "schedules", $schedule_id, $member_id);
            }
        }
    }
}

Header("Location:../View/User1/dashboard.php#workout-schedule");
exit();

?>
