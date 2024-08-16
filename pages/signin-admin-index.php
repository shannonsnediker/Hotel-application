<?php
include '../config.php';

if(isset($_COOKIE["signedAdmin"]))
{
    header("Location: http://54.39.84.236/web-107/final-project/pages/admin-page.php");
}
?>

<h1>Sign in Admin User</h1>
<form action="../controllers/signin-admin.php" method="post">
    <label for="Username">username</label><br>
    <input type="text" name="Username"><br>
    <label for="Password">password</label><br>
    <input type="password" name="Password"><br>
    <!-- <label for="userType">Please enter guest or admin</label><br>
    <input type="text" name="userType"><br> -->
    <input type="submit" value="submit">
</form>