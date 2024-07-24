<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $venueName = $_POST['venueName'];
    $address = $_POST['address'];
    $capacity = $_POST['capacity'];
    $eventID = $_POST['eventID'];

    $sql = "INSERT INTO Venue (VenueName, Address, Capacity, EventID) VALUES ('$venueName', '$address', '$capacity', '$eventID')";

    if ($conn->query($sql) === TRUE) {
        echo "New venue added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
