<?php

$servername = "localhost"; // setting servername to global variable
$username = "admin1"; // setting username to global variable
$password = "Powerful25!"; // setting server pswd to global variable

try { // try statement to catch the exception
  $conn = new PDO("mysql:host=$servername;dbname=lodge", $username, $password); // establish PDO connection

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // setting attributes for the PDO to enable exception mode

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}; // catching and handling any PDO exceptions that may occur

ini_set('display_errors', 1); // displays errors on the screen
ini_set('display_startup_errors', 1); // displays errors from the startup sequence
error_reporting(E_ALL); // setting error reporting level to E_ALL so that all types of errors and warnings are reported


?>