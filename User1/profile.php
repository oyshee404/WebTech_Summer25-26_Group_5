<?php
include "../../Controller/ProfileValidation.php";

if($_SESSION["role"] == "Member" && "User1" != "User1") { Header("Location:../login.php"); exit(); }
if($_SESSION["role"] == "Trainer" && "User1" != "User2") { Header("Location:../login.php"); exit(); }
if($_SESSION["role"] == "Admin" && "User1" != "User3") { Header("Location:../login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../../Design/Style.css">
<script src="../../JS/script.js"></script>
<title>My Profile</title>
</head>
<body>
<div class="header"><h1>My Profile</h1></div>
<div class="topnav">
<a href="dashboard.php">Dashboard</a>
<a href="profile.php">Profile</a>
<a href="change_password.php">Change Password</a>
<a class="right" href="../logout.php">Logout</a>
</div>
<div class="container">
<?php echo $message; ?>
<form method="post" action="" onsubmit="return collect_data()">
<fieldset><legend>Profile Information</legend>
<table>
<tr><td><label for="name">Full Name:</label></td><td><input type="text" id="name" name="name" value="<?php echo $user["name"]; ?>"></td></tr>
<tr><td><label for="email">Email:</label></td><td><input type="email" id="email" name="email" value="<?php echo $user["email"]; ?>"></td></tr>
<tr><td><label for="phone">Phone:</label></td><td><input type="text" id="phone" name="phone" value="<?php echo $user["phone"]; ?>"></td></tr>
<tr><td><label for="address">Address:</label></td><td><textarea id="address" name="address" rows="4"><?php echo $user["address"]; ?></textarea></td></tr>

<tr><td colspan="2" class="center"><input class="button" type="submit" value="Save Changes"><a class="button button-danger" href="../../Controller/DeleteProfile.php" onclick="return confirmDelete()">Delete Profile</a></td></tr>
</table>
</fieldset>
</form>
</div>
<div class="footer"><label>Gym Management System - 2026</label></div>
</body>
</html>
