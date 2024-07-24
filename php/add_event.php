<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $budget = $_POST['budget'];
    $location = $_POST['location'];
    $organizerID = $_POST['organizerID'];

    $sql = "INSERT INTO Event (EventName, EventDate, Budget, Location, OrganizerID) VALUES ('$eventName', '$eventDate', '$budget', '$location', '$organizerID')";

    if ($conn->query($sql) === TRUE) {
        echo "New event added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
