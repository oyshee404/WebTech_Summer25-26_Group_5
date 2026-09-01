<?php
include "../../Model/db.php";
session_start();

if(!isset($_SESSION["logged_in"]) || $_SESSION["role"] != "Trainer")
{
    Header("Location:../login.php");
    exit();
}

$database = new db();
$connection = $database->connection();
$members = $database->getAssignedMembers($connection, "users", "trainer_assignments", $_SESSION["user_id"]);
$memberCount = $members ? $members->num_rows : 0;
$scheduleCount = $database->getScheduleCount($connection, "schedules", $_SESSION["user_id"]);
$sessionCount = $database->getCompletedSessionCount($connection, "schedules", $_SESSION["user_id"]);
?>
<!DOCTYPE html>
<html lang="en-US">
<head><meta charset="UTF-8"><link rel="stylesheet" href="../../Design/Style.css"><title>Trainer Dashboard</title></head>
<body>
<div class="header"><h1>Gym Management System</h1></div>
<div class="topnav"><a href="dashboard.php">Dashboard</a><a href="profile.php">My Profile</a><a href="change_password.php">Change Password</a><a class="right" href="../logout.php">Logout</a></div>
<div class="dashboard-container">
<div class="dashboard-title"><h2>Welcome, <?php echo $_SESSION["username"]; ?></h2><p>Your personalized trainer dashboard.</p></div>
<div class="info"><b>User Type:</b> Trainer</div>
<table class="card-table"><tr>
<td><div class="card"><h3>Members</h3><div class="number"><?php echo $memberCount; ?></div><p>Assigned</p></div></td>
<td><div class="card"><h3>Sessions</h3><div class="number"><?php echo $sessionCount; ?></div><p>Completed</p></div></td>
<td><div class="card"><h3>Schedule</h3><div class="number"><?php echo $scheduleCount; ?></div><p>Assigned</p></div></td>
</tr></table>
<fieldset><legend>Trainer Options</legend><table>
<tr><td><a class="button" href="profile.php">View / Edit Profile</a></td><td><a class="button" href="members.php">View Members</a></td></tr>
<tr><td><a class="button" href="schedule.php">Training Schedule</a></td><td><a class="button button-secondary" href="../logout.php">Logout</a></td></tr>
</table></fieldset>
</div>
<div class="footer"><label>Gym Management System - 2026</label></div>
</body></html>
