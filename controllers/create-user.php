<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config.php'; // including our configuration file that signs us into a session on our server

$userType = "guest"; // setting global variable equal to set string value guest for future login/access purposes

$sql1 = "INSERT INTO userType (userType) VALUES (?)"; // creating statement to insert the "guest" valye into the userType table

// setting super global variables equal to the corresponding value retrieved in the POST request on create-user-index.php
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$address = $_POST['address'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$username = $_POST['username']; 
$password = $_POST['password']; 

$sql2 = "INSERT INTO users (fName,lName,address,email,phoneNumber,username,password,userTypeId) VALUES (?,?,?,?,?,?,?,?)"; // using prepared statement to bind values to placeholders



try { // try statement to execute the 3 following commands

    $stmt = $conn->prepare($sql1); // command 1 to insert userType data into userType table in database
    $stmt->bindParam(1,$userType);
    $stmt->execute();

    $userTypeIdQuery = "SELECT userTypeId FROM userType WHERE userType = ?"; // command 2 to query the inserted userType data and set it to global variable $userType. This is so that the userTypeId foreign key of the users table can be updated with this information
    $stmt = $conn->prepare($userTypeIdQuery);
    $stmt->bindParam(1, $userType);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $userTypeId = $result['userTypeId'];

    $stmt = $conn->prepare($sql2); // command 3 to insert data from form fields and from command 2 query into users database
    $stmt->bindParam(1,$fName);
    $stmt->bindParam(2,$lName);
    $stmt->bindParam(3,$address);
    $stmt->bindParam(4,$email);
    $stmt->bindParam(5,$phoneNumber);
    $stmt->bindParam(6,$username);
    $stmt->bindParam(7,$password);
    $stmt->bindParam(8,$userTypeId);
    $stmt->execute();

    echo "record inserted correctly";

    header("Location: http://54.39.84.236/web-107/final-project/pages/home-page.php"); // redirect to home page

    exit();

} catch (\PDOException $e) { // display eerror messages
    echo "error" . $e->getMessage();
};



?>