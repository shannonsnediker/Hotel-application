
<?php

include "../config.php"; // including file with server connection details

error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = $_POST['username']; // setting form data from signin-user-index.php to global variables
/* $userType = $_POST['userType']; */
$password = $_POST['password'];


/* $sql = "SELECT users.userId, users.password, userType.userType
FROM users
INNER JOIN userType ON users.userTypeId = userType.userTypeId
WHERE users.username = ?"; */ // 

$sql = "SELECT * FROM users WHERE username = ?"; // querying username from the users table to the bound parameter username 
 
try {

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$username); 
    $stmt->execute();

        while($row = $stmt->fetch()) {
            // echo $row['password'];
            if($row['password'] === $password) {

                setcookie("signedUser", $username, time() + (86400), "/");

                header("Location: http://54.39.84.236/web-107/final-project/pages/home-page.php");
            }

            else {
                echo "sign in failed";
            }
        }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
};



/*
try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['password'] === $password) {
        $userType = $result['userType'];

        switch ($userType) {
            case 'guest':
            header("Location: http://54.39.84.236/web-107/final-project/pages/home-page.php");
            exit();
            break;

        case 'admin':
            header("Location: http://54.39.84.236/web-107/final-project/pages/admin-user-index.php");
            setcookie("signedUser", $username, time() + (86400), "/");
            exit();
            break;
        }
            echo "user signed in";
    } else {
            echo "sign in failed";
        }
    } 
*/

?>