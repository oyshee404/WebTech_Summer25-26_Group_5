<?php
include "../../Controller/ScheduleValidation.php";
?>
<!DOCTYPE html>
<html lang="en-US"><head><meta charset="UTF-8"><link rel="stylesheet" href="../../Design/Style.css"><title>Training Schedule</title></head>
<body>
<div class="header"><h1>Training Schedule</h1></div>
<div class="topnav"><a href="dashboard.php">Dashboard</a><a href="profile.php">Profile</a><a href="members.php">Assigned Members</a><a class="right" href="../logout.php">Logout</a></div>
<div class="container">
<?php echo $message; ?>
<fieldset><legend>Assign Workout Schedule</legend>
<form method="post" action="">
<table>
<tr><td><label for="member_id">Member:</label></td><td>
<select id="member_id" name="member_id">
<option value="">Select Member</option>
<?php
if($members && $members->num_rows > 0)
{
    while($member = $members->fetch_assoc())
    {
        echo "<option value='".$member["id"]."'>".$member["name"]." (".$member["username"].")</option>";
    }
}
?>
</select>
</td></tr>
<tr><td><label for="schedule_date">Date:</label></td><td><input type="date" id="schedule_date" name="schedule_date"></td></tr>
<tr><td><label for="time">Time:</label></td><td><input type="text" id="time" name="time" placeholder="5:00 PM"></td></tr>
<tr><td><label for="activity">Workout / Activity:</label></td><td><input type="text" id="activity" name="activity" placeholder="Chest and Triceps"></td></tr>
<tr><td colspan="2" class="center"><input class="button" type="submit" value="Assign Workout"></td></tr>
</table>
</form>
</fieldset>

<fieldset><legend>Assigned Workout Schedules</legend><table border="1">
<tr><td><b>Member</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>Workout</b></td><td><b>Status</b></td><td><b>Action</b></td></tr>
<?php
if($schedule && $schedule->num_rows > 0)
{
    while($row = $schedule->fetch_assoc())
    {
        $memberResult = $connection->query("SELECT name FROM users WHERE id='".$row["member_id"]."'");
        $memberName = "Unknown";
        if($memberResult && $memberResult->num_rows > 0)
        {
            $memberData = $memberResult->fetch_assoc();
            $memberName = $memberData["name"];
        }
        echo "<tr>";
        echo "<td>".$memberName."</td>";
        echo "<td>".$row["schedule_date"]."</td>";
        echo "<td>".$row["time"]."</td>";
        echo "<td>".$row["activity"]."</td>";
        echo "<td>".$row["status"]."</td>";
        echo "<td><a href='schedule.php?delete=".$row["id"]."'>Delete</a></td>";
        echo "</tr>";
    }
}
else
{
    echo "<tr><td colspan='6'>No workout schedule added</td></tr>";
}
?>
</table></fieldset>
<div class="center"><a class="button" href="dashboard.php">Back</a></div>
</div>
<div class="footer"><label>Gym Management System - 2026</label></div></body></html>
