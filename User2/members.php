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
$result = $database->getAssignedMembers($connection, "users", "trainer_assignments", $_SESSION["user_id"]);
?>
<!DOCTYPE html>
<html lang="en-US"><head><meta charset="UTF-8"><link rel="stylesheet" href="../../Design/Style.css"><title>Assigned Members</title></head>
<body>
<div class="header"><h1>Assigned Members</h1></div>
<div class="topnav"><a href="dashboard.php">Dashboard</a><a class="right" href="../logout.php">Logout</a></div>
<div class="container"><fieldset><legend>Member List</legend><table border="1">
<tr><td><b>ID</b></td><td><b>Name</b></td><td><b>Membership</b></td><td><b>Status</b></td></tr>
<?php
if($result && $result->num_rows > 0)
{
    while($member = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>".$member["id"]."</td>";
        echo "<td>".$member["name"]."</td>";
        echo "<td>".$member["membership"]."</td>";
        echo "<td><span class='status'>Active</span></td>";
        echo "</tr>";
    }
}
else
{
    echo "<tr><td colspan='4'>No assigned members</td></tr>";
}
?>
</table></fieldset><div class="center"><a class="button" href="dashboard.php">Back</a></div></div>
<div class="footer"><label>Gym Management System - 2026</label></div></body></html>
