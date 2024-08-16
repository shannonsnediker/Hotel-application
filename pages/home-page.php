<?php

include '../config.php'; // separating the code into different files keeps the database connection details more secure

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_COOKIE["signedUser"]))
{
    header("Location: http://54.39.84.236/web-107/final-project/controllers/signin-user.php");
};

$sql = "SELECT * FROM roomType"; 

$results = $conn->query($sql);

while ($row = $results->fetch()) {
    echo "<div class='room-info' data-room-type='{$row['roomType']}' data-room-capacity='{$row['roomCapacity']}' data-pets-allowed='{$row['petsAllowed']}'>
        <p>Room Type: " . $row['roomType'] . "</p>
        <p>Capacity: " . $row['roomCapacity'] . "</p>
        <p>Pets Allowed: " . ($row['petsAllowed'] ? 'Yes' : 'No') . "</p>";
}

?> 

<form action="" method="post">
        <label for="roomType">Select Room Type:</label>
        <select id="roomType" name="roomType">
            <option value="Queen-Yes">Queen, 2, Yes</option>
            <option value="Queen-No">Queen, 2, No</option>
            <option value="King-Yes">King, 2, Yes</option>
            <option value="King-No">King, 2, No</option>
            <option value="Double-Yes">Double, 4, Yes</option>
            <option value="Double-No">Double, 4, No</option>
            <option value="Suite-Yes">Suite, 6, Yes</option>
            <option value="Suite-No">Suite, 6, No</option>
        </select>


        <label for="checkIn">Check-In Date:</label>
        <input type="date" id="checkIn" name="checkIn" required>

        <br>

        <label for="checkOUt">Check-Out Date:</label>
        <input type="date" id="checkOut" name="checkOut" required>

        <br>

        <label for="numberOfGuests">Number of Guests:</label>
        <select id="numberOfGuests" name="numberOfGuests">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>

        <br>

        <label for="petsAllowed">Pets:</label>
        <select id="petsAllowed" name="petsAllowed">
            <option value="1">Yes</option>
            <option value="2">No</option>

        <input type="submit" name="submit" value="submit">
    </form>

<?php

$username = $_COOKIE["signedUser"];

$sql1 = "SELECT userId FROM users WHERE username = ?";
$stmt = $conn->prepare($sql1);
$stmt->bindParam(1, $username);
$stmt->execute();

if ($row = $stmt->fetch()) {
    $userId = $row['userId'];



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    $roomType = $_POST['roomType'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
    $numberOfGuests = $_POST['numberOfGuests'];
    $petsAllowed = $_POST['petsAllowed'];

    $stmt = $conn->prepare("INSERT INTO reservations (userId, roomType, checkIn, checkOut, numberOfGuests, specialNeeds) VALUES (?, ?, ?, ?, ?, ?)");
    
    $stmt->bindParam(1, $userId);
    $stmt->bindParam(2, $roomType);
    $stmt->bindParam(3, $checkIn);
    $stmt->bindParam(4, $checkOut);
    $stmt->bindParam(5, $numberOfGuests);
    $stmt->bindParam(6, $petsAllowed);

    $stmt->execute();

    header('Location: http://54.39.84.236/web-107/final-project/pages/reservations-index.php');
}
}

?>





