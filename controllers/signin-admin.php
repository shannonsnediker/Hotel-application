<?php
include "../config.php"; // including file with server connection details

error_reporting(E_ALL);
ini_set('display_errors', 1);

$adminUsername = $_POST['Username']; 
$adminPassword = $_POST['Password'];

$sql = "SELECT * FROM users WHERE username = ?"; // querying username from the users table to the bound parameter username 
 
try {

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $adminUsername); 
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        if ($row['password'] === $adminPassword) {
            // setcookie("signedAdmin", $adminUsername, time() + (86400), "/");
            header("Location: http://54.39.84.236/web-107/final-project/pages/admin-page.php");
        } else {
            echo "Sign-in failed. Incorrect password.";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
};
?>
