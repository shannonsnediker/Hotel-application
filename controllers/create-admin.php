<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config.php'; // including our configuration file that signs us into a session on our server

$employeeId = $_POST['employeeId']; // setting super global equal to the employee number entered in the create admin form

$sql1 = "SELECT * FROM employees WHERE employeeId = ?";

try { // try statement to see if employee exists in the employees table
    $stmt = $conn->prepare($sql1); // command 1 to insert userType data into userType table in database
    $stmt->bindParam(1,$employeeId);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){

        $userType = "admin"; // setting global variable equal to set string value guest for future login/access purposes

        $sql2 = "INSERT INTO userType (userType) VALUES (?)"; // creating statement to insert the "admin" value into the userType table

        // setting super global variables equal to the corresponding value retrieved in the POST request on create-user-index.php
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $username = $_POST['username']; 
        $password = $_POST['password']; 


        $sql3 = "INSERT INTO users (fName,lName,username,password,userTypeId) VALUES (?,?,?,?,?)"; // using prepared statement to bind values to placeholders

        try { // try statement to execute the 3 following commands to create the account

            $stmt = $conn->prepare($sql2); // command 1 to insert userType data into userType table in database
            $stmt->bindParam(1,$userType);
            $stmt->execute();

            $userTypeIdQuery = "SELECT userTypeId FROM userType WHERE userType = ?"; // command 2 to query the inserted userType data and set it to global variable $userType. This is so that the userTypeId foreign key of the users table can be updated with this information
            $stmt = $conn->prepare($userTypeIdQuery);
            $stmt->bindParam(1, $userType);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $userTypeId = $result['userTypeId'];

            $stmt = $conn->prepare($sql3); // command 3 to insert data from form fields and from command 2 query into users database
            $stmt->bindParam(1,$fName);
            $stmt->bindParam(2,$lName);
            $stmt->bindParam(3,$username);
            $stmt->bindParam(4,$password);
            $stmt->bindParam(5,$userTypeId);
            $stmt->execute();

            echo "record inserted correctly";

            header("Location: http://54.39.84.236/web-107/final-project/pages/admin-page.php"); // redirect to admin page

            exit();

        } catch (\PDOException $e) { // display error messages
        echo "error" . $e->getMessage();
    }
    } else {
        echo '<script>
                alert("Employee is not found in our records. Please contact your manager.");
            </script>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
};





?>