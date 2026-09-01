<?php
include "../Controller/RegistrationValidation.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../Design/Style.css">
<script src="../JS/script.js"></script>
<script src="../JS/CheckUser.js"></script>
<title>Gym Management - Registration</title>
<style>
    #userresponse {
        color: black;
    }
</style>
</head>
<body>
<div class="header"><h1>Gym Management System</h1></div>
<div class="topnav">
<a href="login.php">Login</a>
<a href="registration.php">Registration</a>
</div>

<div class="container">
<form method="post" action="" onsubmit="return collect_data()">
<?php echo $message; ?>
<fieldset>
<legend>Member Registration</legend>
<table>
<tr><td><label for="name">Full Name:</label></td>
<td><input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Enter your full name"></td></tr>

<tr><td><label for="email">Email:</label></td>
<td><input type="email" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your email"></td></tr>

<tr><td><label>Gender:</label></td>
<td>
<input type="radio" id="male" name="gender" value="Male" <?php echo $gender=="Male" ? "checked" : ""; ?>>
<label for="male">Male</label>
<input type="radio" id="female" name="gender" value="Female" <?php echo $gender=="Female" ? "checked" : ""; ?>>
<label for="female">Female</label>
</td></tr>

<tr><td><label for="phone">Phone:</label></td>
<td><input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="Enter phone number"></td></tr>

<tr><td><label for="dob">Date of Birth:</label></td>
<td><input type="date" id="dob" name="dob" value="<?php echo $dob; ?>"></td></tr>

<tr><td><label for="membership">Membership:</label></td>
<td>
<select id="membership" name="membership">
<option value="">---- Select Membership ----</option>
<option value="Basic" <?php echo $membership=="Basic" ? "selected" : ""; ?>>Basic</option>
<option value="Standard" <?php echo $membership=="Standard" ? "selected" : ""; ?>>Standard</option>
<option value="Premium" <?php echo $membership=="Premium" ? "selected" : ""; ?>>Premium</option>
</select>
</td></tr>

<tr><td><label for="address">Address:</label></td>
<td><textarea id="address" name="address" rows="4" placeholder="Enter your address"><?php echo $address; ?></textarea></td></tr>

<tr><td><label for="username">User Name:</label></td>
<td>
<input type="text" id="username" name="username" value="<?php echo $username; ?>" placeholder="Create a username" onkeyup="CheckUser()">
<span id="userresponse"></span>
</td></tr>

<tr><td><label for="password">Password:</label></td>
<td><input type="password" id="password" name="password" placeholder="Create a password"></td></tr>

<tr><td><label for="confirmPassword">Confirm Password:</label></td>
<td><input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password"></td></tr>

<tr><td colspan="2">
<input type="checkbox" id="condition" name="condition" <?php echo isset($_POST["condition"]) ? "checked" : ""; ?>>
<label for="condition"> I Agree to the Terms and Conditions</label>
</td></tr>

<tr><td colspan="2" class="center">
<input class="button" type="submit" value="Register">
<input class="button button-secondary" type="reset" value="Reset">
</td></tr>
</table>
</fieldset>
</form>
</div>

<div class="footer"><label>Gym Management System - 2026</label></div>
</body>
</html>
