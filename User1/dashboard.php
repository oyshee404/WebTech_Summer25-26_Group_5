<?php
include "../../Model/db.php";
session_start();

if(!isset($_SESSION["logged_in"]) || $_SESSION["role"] != "Member")
{
    Header("Location:../login.php");
    exit();
}

$database = new db();
$connection = $database->connection();
$user = $database->getUser($connection, "users", $_SESSION["username"]);
$trainerName = "Not Assigned";
$memberSchedules = false;
$completedSessions = 0;
if($user)
{
    $assignedTrainer = $database->getAssignedTrainer($connection, "trainer_assignments", $user["id"]);
    if($assignedTrainer)
    {
        $trainerName = $assignedTrainer["name"];
    }
    $memberSchedules = $database->getMemberSchedules($connection, "schedules", $user["id"]);
    $completedSessions = $database->getMemberCompletedSessionCount($connection, "schedules", $user["id"]);
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head><meta charset="UTF-8"><link rel="stylesheet" href="../../Design/Style.css"><title>Member Dashboard</title></head>
<body>
<div class="header"><h1>Gym Management System</h1></div>
<div class="topnav">
<a href="dashboard.php">Dashboard</a>
<a href="profile.php">My Profile</a>
<a href="change_password.php">Change Password</a>
<a class="right" href="../logout.php">Logout</a>
</div>
<div class="dashboard-container">
<div class="dashboard-title"><h2>Welcome, <?php echo $_SESSION["username"]; ?></h2><p>This is your personalized member dashboard.</p></div>
<div class="info"><b>User Type:</b> Gym Member</div>
<table class="card-table"><tr>
<td><div class="card"><h3>Membership</h3><div class="number"><?php echo $user["membership"]; ?></div><p>Current Plan</p></div></td>
<td><div class="card"><h3>Status</h3><div class="number">Active</div><p>Membership</p></div></td>
<td><div class="card"><h3>Trainer</h3><div class="number"><?php echo $trainerName; ?></div><p>Assigned</p></div></td>
<td><div class="card"><h3>Sessions</h3><div class="number"><?php echo $completedSessions; ?></div><p>Completed</p></div></td>
</tr></table>
<fieldset><legend>Member Options</legend><table>
<tr><td><a class="button" href="profile.php">View / Edit Profile</a></td><td><a class="button" href="change_password.php">Change Password</a></td></tr>
<tr><td><a class="button" href="membership.php">My Membership</a></td><td><a class="button" href="membership_plans.php">Membership Plans</a></td></tr>
<tr><td><a class="button" href="#workout-schedule">My Workout Schedule</a></td><td><a class="button button-secondary" href="../logout.php">Logout</a></td></tr>
</table></fieldset>

<fieldset id="workout-schedule"><legend>My Workout Schedule</legend>
<table border="1">
<tr><td><b>Trainer</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>Workout / Activity</b></td><td><b>Status</b></td><td><b>Action</b></td></tr>
<?php
if($memberSchedules && $memberSchedules->num_rows > 0)
{
    while($row = $memberSchedules->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>".$row["trainer_name"]."</td>";
        echo "<td>".$row["schedule_date"]."</td>";
        echo "<td>".$row["time"]."</td>";
        echo "<td>".$row["activity"]."</td>";
        echo "<td>".$row["status"]."</td>";
        if($row["status"] == "Scheduled")
        {
            $scheduledDateTime = strtotime($row["schedule_date"] . " " . $row["time"]);
            if($scheduledDateTime !== false && $scheduledDateTime <= time())
            {
                echo "<td><a class='button' href='../../Controller/CompleteSchedule.php?id=".$row["id"]."'>Complete Workout</a></td>";
            }
            else
            {
                echo "<td>Upcoming</td>";
            }
        }
        else
        {
            echo "<td>Completed</td>";
        }
        echo "</tr>";
    }
}
else
{
    echo "<tr><td colspan='6'>No workout schedule assigned yet.</td></tr>";
}
?>
</table>
</fieldset>
</div>
<div class="footer"><label>Gym Management System - 2026</label></div>
</body>
</html>
