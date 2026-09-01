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
$result = $database->getTrainers($connection, "users");
?>
<!DOCTYPE html>
<html lang="en-US"><head><meta charset="UTF-8"><link rel="stylesheet" href="../../Design/Style.css"><title>Manage Trainers</title></head>
<body>
<div class="header"><h1>Manage Trainers</h1></div>
<div class="topnav"><a href="dashboard.php">Dashboard</a><a class="right" href="../logout.php">Logout</a></div>
<div class="container"><fieldset><legend>Trainer List</legend><table border="1">
<tr><td><b>ID</b></td><td><b>Name</b></td><td><b>Username</b></td><td><b>Specialty</b></td><td><b>Status</b></td></tr>
<?php
if($result && $result->num_rows > 0)
{
    while($trainer = $result->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>".$trainer["id"]."</td>";
        echo "<td>".$trainer["name"]."</td>";
        echo "<td>".$trainer["username"]."</td>";
        echo "<td>".$trainer["specialty"]."</td>";
        echo "<td><span class='status'>Active</span></td>";
        echo "</tr>";
    }
}
else
{
    echo "<tr><td colspan='5'>No trainers registered</td></tr>";
}
?>
</table></fieldset><div class="center"><a class="button" href="dashboard.php">Back</a></div></div>
<div class="footer"><label>Gym Management System - 2026</label></div></body></html>
