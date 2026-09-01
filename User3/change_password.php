<?php
include "../../Controller/ChangePasswordValidation.php";

if(("User3" == "User1" && $_SESSION["role"] != "Member") ||
   ("User3" == "User2" && $_SESSION["role"] != "Trainer") ||
   ("User3" == "User3" && $_SESSION["role"] != "Admin"))
{
    Header("Location:../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../../Design/Style.css">
<script src="../../JS/script.js"></script>
<title>Change Password</title>
</head>
<body>
<div class="header"><h1>Change Password</h1></div>
<div class="topnav">
<a href="dashboard.php">Dashboard</a>
<a href="profile.php">Profile</a>
<a href="change_password.php">Change Password</a>
<a class="right" href="../logout.php">Logout</a>
</div>
<div class="container">
<?php echo $message; ?>
<form method="post" action="" onsubmit="return collect_data()">
<fieldset><legend>Change Password</legend><table>
<tr><td><label for="oldPassword">Current Password:</label></td><td><input type="password" id="oldPassword" name="oldPassword"></td></tr>
<tr><td><label for="password">New Password:</label></td><td><input type="password" id="password" name="password"></td></tr>
<tr><td><label for="confirmPassword">Confirm New Password:</label></td><td><input type="password" id="confirmPassword" name="confirmPassword"></td></tr>
<tr><td colspan="2" class="center"><input class="button" type="submit" value="Update Password"></td></tr>
</table></fieldset>
</form></div>
<div class="footer"><label>Gym Management System - 2026</label></div>
</body>
</html>
