<?php
include '../config.php';

if(isset($_COOKIE["signedUser"]))
{
    header("Location: http://54.39.84.236/web-107/final-project/pages/home-page.php");
}
?>

<h1>Sign in User</h1>
<form action="../controllers/signin-user.php" method="post">
    <label for="username">username</label><br>
    <input type="text" name="username"><br>
    <label for="password">password</label><br>
    <input type="password" name="password"><br>
    <!-- <label for="userType">Please enter guest or admin</label><br>
    <input type="text" name="userType"><br> -->
    <input type="submit" value="submit">
</form>

