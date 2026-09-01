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
$plans = $database->getPlans($connection, "membership_plans");
?>
<!DOCTYPE html>
<html lang="en-US">
<head><meta charset="UTF-8"><link rel="stylesheet" href="../../Design/Style.css"><title>Membership Plans</title></head>
<body>
<div class="header"><h1>Membership Plans</h1></div>
<div class="topnav"><a href="dashboard.php">Dashboard</a><a href="membership.php">My Membership</a><a href="profile.php">Profile</a><a class="right" href="../logout.php">Logout</a></div>
<div class="container">
<fieldset><legend>Available Membership Plans</legend>
<table border="1">
<tr><td><b>Plan</b></td><td><b>Duration</b></td><td><b>Facilities</b></td><td><b>Price</b></td></tr>
<?php
if($plans && $plans->num_rows > 0)
{
    while($row = $plans->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["duration"]."</td>";
        echo "<td>".$row["facilities"]."</td>";
        echo "<td>৳".$row["price"]."</td>";
        echo "</tr>";
    }
}
else
{
    echo "<tr><td colspan='4'>No membership plans available.</td></tr>";
}
?>
</table>
</fieldset>
<div class="center"><a class="button" href="dashboard.php">Back to Dashboard</a></div>
</div>
<div class="footer"><label>Gym Management System - 2026</label></div>
</body></html>
