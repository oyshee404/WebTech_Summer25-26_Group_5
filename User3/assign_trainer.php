<?php
include "../../Controller/AssignTrainerValidation.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../../Design/Style.css">
<title>Assign Trainer</title>
</head>
<body>
<div class="header"><h1>Assign Trainer to Member</h1></div>
<div class="topnav">
<a href="dashboard.php">Dashboard</a>
<a href="members.php">Members</a>
<a href="trainers.php">Trainers</a>
<a class="right" href="../logout.php">Logout</a>
</div>

<div class="container">
<fieldset>
<legend>Trainer Assignment</legend>

<?php if(!empty($message)) { ?>
<p><?php echo $message; ?></p>
<?php } ?>

<form method="post" action="">
<table>
<tr>
<td><label for="member_id">Select Member:</label></td>
<td>
<select name="member_id" id="member_id">
<option value="">-- Select Member --</option>
<?php
if($members && $members->num_rows > 0)
{
    while($member = $members->fetch_assoc())
    {
        $assignedTrainer = $database->getAssignedTrainer($connection, "trainer_assignments", $member["id"]);
        $trainerText = $assignedTrainer ? " - Current: ".$assignedTrainer["name"] : " - Not Assigned";
        echo "<option value='".$member["id"]."'>".$member["name"]." (".$member["username"].")".$trainerText."</option>";
    }
}
?>
</select>
</td>
</tr>

<tr>
<td><label for="trainer_id">Select Trainer:</label></td>
<td>
<select name="trainer_id" id="trainer_id">
<option value="">-- Select Trainer --</option>
<?php
if($trainers && $trainers->num_rows > 0)
{
    while($trainer = $trainers->fetch_assoc())
    {
        echo "<option value='".$trainer["id"]."'>".$trainer["name"]." - ".$trainer["specialty"]."</option>";
    }
}
?>
</select>
</td>
</tr>

<tr>
<td></td>
<td><input class="button" type="submit" value="Assign Trainer"></td>
</tr>
</table>
</form>
</fieldset>

<div class="center">
<a class="button" href="dashboard.php">Back to Dashboard</a>
</div>
</div>

<div class="footer"><label>Gym Management System - 2026</label></div>
</body>
</html>
