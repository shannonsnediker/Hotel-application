<?php
include '../config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_COOKIE["signedUser"])) {
    header("Location: http://54.39.84.236/web-107/final-project/controllers/signin-user.php");
    exit();
}

$username = $_COOKIE["signedUser"];

$sql1 = "SELECT userId FROM users WHERE username = ?";
$stmt = $conn->prepare($sql1);
$stmt->bindParam(1, $username);
$stmt->execute();

if ($row = $stmt->fetch()) {
    $userId = $row['userId'];

    // Fetch reservations based on userId
    $sqlFetchReservations = "SELECT * FROM reservations WHERE userId = ?";
    $stmtReservations = $conn->prepare($sqlFetchReservations);
    $stmtReservations->bindParam(1, $userId);
    $stmtReservations->execute();

    // Check if there are results before fetching
    if ($stmtReservations) {
        // Display reservations
        while ($reservation = $stmtReservations->fetch()) {
            echo "<div class='reservation-info'>
                <p>Reservation ID: " . $reservation['reservationId'] . "</p>
                <p>Check-In Date: " . $reservation['checkIn'] . "</p>
                <p>Check-Out Date: " . $reservation['checkOut'] . "</p>
                <p>Number of Guests: " . $reservation['numberOfGuests'] . "</p>
                <p>Special Needs: " . $reservation['specialNeeds'] . "</p>
            </div>";
        }
    } else {
        echo "No reservations found for the user.";
    }
} else {
    echo "Unable to load reservations";
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['reservationId'])) {
        $reservationId = $_GET['reservationId'];
        $stmt = $conn->prepare('DELETE FROM reservations WHERE reservationID = ?');
        $stmt->bindParam(1, $reservationId);
        $stmt->execute();

        echo "Reservation deleted. To make a new one please navigate back to the reservations tab";
    }
}


?>

<li><a href="home-page.php">Create another reservation</a></li>

<h1>Delete Reservation</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
    <label for="reservationId">ReservationId</label><br>
    <input type="text" name="reservationId"><br>
    <input type="submit" value="submit">
</form>
