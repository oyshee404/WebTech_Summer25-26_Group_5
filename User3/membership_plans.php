<?php
include "../../Controller/AdminPlanValidation.php";
?>
<!DOCTYPE html>
<html lang="en-US"><head><meta charset="UTF-8"><link rel="stylesheet" href="../../Design/Style.css"><title>Membership Plans</title></head>
<body>
<div class="header"><h1>Manage Membership Plans</h1></div>
<div class="topnav"><a href="dashboard.php">Dashboard</a><a class="right" href="../logout.php">Logout</a></div>
<div class="container">
<?php echo $message; ?>
<fieldset><legend>Add Membership Plan</legend>
<form method="post" action="">
<table>
<tr><td><label for="name">Plan Name:</label></td><td><input type="text" id="name" name="name"></td></tr>
<tr><td><label for="duration">Duration:</label></td><td><input type="text" id="duration" name="duration"></td></tr>
<tr><td><label for="facilities">Facilities:</label></td><td><input type="text" id="facilities" name="facilities"></td></tr>
<tr><td><label for="price">Price:</label></td><td><input type="text" id="price" name="price"></td></tr>
<tr><td colspan="2" class="center"><input class="button" type="submit" value="Add Plan"></td></tr>
</table>
</form>
</fieldset>

<fieldset><legend>Available Plans</legend><table class="menu-table">
<tr><td><b>Name</b></td><td><b>Duration</b></td><td><b>Facilities</b></td><td><b>Price</b></td><td><b>Action</b></td></tr>
<?php
if($plans && $plans->num_rows > 0)
{
    while($plan = $plans->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>".$plan["name"]."</td>";
        echo "<td>".$plan["duration"]."</td>";
        echo "<td>".$plan["facilities"]."</td>";
        echo "<td>৳".$plan["price"]."</td>";
        echo "<td><a href='membership_plans.php?delete=".$plan["id"]."'>Delete</a></td>";
        echo "</tr>";
    }
}
else
{
    echo "<tr><td colspan='5'>No membership plans found</td></tr>";
}
?>
</table></fieldset>
<div class="center"><a class="button" href="dashboard.php">Back</a></div>
</div>
<div class="footer"><label>Gym Management System - 2026</label></div></body></html>
