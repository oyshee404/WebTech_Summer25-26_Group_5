<?php
include "../../Model/db.php";
session_start();

if(!isset($_SESSION["logged_in"]) || $_SESSION["role"] != "Admin")
{
    Header("Location:../login.php");
    exit();
}

$database = new db();
$connection = $database->connection();

$totalMembers = $database->countRole($connection, "users", "Member");
$totalTrainers = $database->countRole($connection, "users", "Trainer");
$plans = $database->getPlans($connection, "membership_plans");
$totalPlans = $plans ? $plans->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="en-US">
<head><meta charset="UTF-8"><link rel="stylesheet" href="../../Design/Style.css"><title>Admin Dashboard</title></head>
<body>
<div class="header"><h1>Gym Management System</h1></div>
<div class="topnav"><a href="dashboard.php">Dashboard</a><a href="profile.php">My Profile</a><a href="change_password.php">Change Password</a><a class="right" href="../logout.php">Logout</a></div>
<div class="dashboard-container">
<div class="dashboard-title"><h2>Welcome, <?php echo $_SESSION["username"]; ?></h2><p>Manage the gym system from your dashboard.</p></div>
<div class="info"><b>User Type:</b> Administrator</div>
<table class="card-table"><tr>
<td><div class="card"><h3>Total Members</h3><div class="number"><?php echo $totalMembers; ?></div><p>Registered</p></div></td>
<td><div class="card"><h3>Trainers</h3><div class="number"><?php echo $totalTrainers; ?></div><p>Active</p></div></td>
<td><div class="card"><h3>Plans</h3><div class="number"><?php echo $totalPlans; ?></div><p>Available</p></div></td>
</tr></table>
<fieldset><legend>Admin Options</legend><table>
<tr><td><a class="button" href="profile.php">View / Edit Profile</a></td><td><a class="button" href="members.php">Manage Members</a></td></tr>
<tr><td><a class="button" href="trainers.php">Manage Trainers</a></td><td><a class="button" href="assign_trainer.php">Assign Trainer</a></td></tr>
<tr><td><a class="button" href="membership_plans.php">Membership Plans</a></td><td></td></tr>
<tr><td><a class="button" href="change_password.php">Change Password</a></td><td><a class="button button-secondary" href="../logout.php">Logout</a></td></tr>
</table></fieldset>
</div>
<div class="footer"><label>Gym Management System - 2026</label></div>
</body></html>
