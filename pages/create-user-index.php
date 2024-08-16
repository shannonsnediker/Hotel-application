<?php

include '../config.php';

if(isset($_COOKIE["signedUser"]))
{
    header("Location: http://54.39.84.236/web-107/final-project/pages/home-page.php");
}


?> 

<h1>Create User</h1>

<form action="../controllers/create-user.php" method="post">
    <label for="fName">First Name</label><br>
    <input type="text" name="fName" required><br>

    <label for="lName">Last Name</label><br>
    <input type="text" name="lName" required><br>

    <label for="address">Address</label><br>
    <input type="text" name="address" required><br>

    <label for="email">Email</label><br>
    <input type="email" name="email" required><br>

    <label for="phoneNumber">Phone Number</label><br>
    <input type="tel" name="phoneNumber"><br>

    <label for="username">Create Username</label><br>
    <input type="text" name="username" required><br>

    <label for="password">Create Password</label><br>
    <input type="text" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required><br>

    <!-- password requirements note -->
    <p class="password-note">Password must contain at least one uppercase letter, one lowercase letter, one special character, one number, and be at least 8 characters long.</p> 

    <input type="submit" value="submit">
</form>

<p>Already a user? <a href="signin-user-index.php">Sign in here</a></p>
<a href="create-admin-index.php">Admin please click here</a>



