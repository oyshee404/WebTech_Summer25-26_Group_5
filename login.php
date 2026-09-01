<?php
include "../Controller/LoginValidation.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../Design/Style.css">
<script src="../JS/script.js"></script>
<title>Gym Management - Login</title>
</head>
<body>
<div class="header"><h1>Gym Management System</h1></div>
<div class="topnav">
<a href="login.php">Login</a>
<a href="registration.php">Registration</a>
</div>

<div class="container">
<form method="post" action="" onsubmit="return collect_data()">
<fieldset>
<legend>Login</legend>
<table>
<tr><td><label for="name">User Name:</label></td>
<td><input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Enter your username"></td></tr>

<tr><td><label for="password">Password:</label></td>
<td><input type="password" id="password" name="password" placeholder="Enter your password"></td></tr>

<tr><td colspan="2"><?php echo $message; ?></td></tr>

<tr><td colspan="2">
<input type="checkbox" id="remember" name="remember" value="1" <?php echo $remember ? "checked" : ""; ?>>
<label for="remember"> Remember Me</label>
</td></tr>

<tr><td colspan="2" class="center">
<input class="button" type="submit" value="Login">
<input class="button button-secondary" type="reset" value="Reset">
</td></tr>
</table>
</fieldset>
</form>

<div class="center">
<p>Don't have an account?</p>
<a class="button" href="registration.php">Create Account</a>
</div>
</div>

<div class="footer"><label>Gym Management System - 2026</label></div>
</body>
</html>
