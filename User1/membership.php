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
$plan = $database->getPlan($connection, "membership_plans", $user["membership"]);
?>
<!DOCTYPE html>
<html lang="en-US">
<head><meta charset="UTF-8"><link rel="stylesheet" href="../../Design/Style.css"><title>Membership</title></head>
<body>
<div class="header"><h1>My Membership</h1></div>
<div class="topnav"><a href="dashboard.php">Dashboard</a><a href="profile.php">Profile</a><a class="right" href="../logout.php">Logout</a></div>
<div class="container">
<fieldset><legend>Membership Details</legend>
<table>
<tr><td><b>Plan:</b></td><td><?php echo $user["membership"]; ?></td></tr>
<tr><td><b>Duration:</b></td><td><?php echo $plan ? $plan["duration"] : "Not Available"; ?></td></tr>
<tr><td><b>Facilities:</b></td><td><?php echo $plan ? $plan["facilities"] : "Not Available"; ?></td></tr>
<tr><td><b>Price:</b></td><td><?php echo $plan ? "৳".$plan["price"] : "Not Available"; ?></td></tr>
<tr><td><b>Status:</b></td><td><span class="status">Active</span></td></tr>
</table>
</fieldset>
<div class="center"><a class="button" href="dashboard.php">Back to Dashboard</a></div>
</div>
<div class="footer"><label>Gym Management System - 2026</label></div>
</body></html>
