<?php 
include '../config.php';

if(isset($_COOKIE["signedAdmin"]))
{
    header("Location: http://54.39.84.236/web-107/final-project/controllers/signin-admin.php");
}

$sql = "SELECT * FROM reservations"; 
$results = $conn->query($sql);

if ($results) {
    // Check if there are any reservations
    if ($results->rowCount() > 0) {
        // Display reservations
        while ($reservation = $results->fetch()) {
            echo "<div class='reservation-info'>
                <p>Reservation ID: " . $reservation['reservationId'] . "</p>
                <p>Check-In Date: " . $reservation['checkIn'] . "</p>
                <p>Check-Out Date: " . $reservation['checkOut'] . "</p>
                <p>Number of Guests: " . $reservation['numberOfGuests'] . "</p>
                <p>Special Needs: " . $reservation['specialNeeds'] . "</p>
            </div>";
        }
    } else {
        echo "No reservations found.";
    }
} else {
    echo "Error executing the query.";
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['reservationId'])) {
        $reservationId = $_GET['reservationId'];
        $stmt = $conn->prepare('DELETE FROM reservations WHERE reservationID = ?');
        $stmt->bindParam(1, $reservationId);
        $stmt->execute();
    }
}

?>

<h1>Delete Reservation</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
    <label for="reservationId">ReservationId</label><br>
    <input type="text" name="reservationId"><br>
    <input type="submit" value="submit">
</form>


